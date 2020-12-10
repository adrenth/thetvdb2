<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Psr7\Response;
use InvalidArgumentException;

/**
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  MIT
 *
 * @see     https://github.com/adrenth/thetvdb2
 */
class Client implements ClientInterface
{
    /**
     * Base URI.
     *
     * @var string
     */
    public const API_BASE_URI = 'https://api.thetvdb.com';

    /**
     * @var HttpClient
     */
    private $httpClient;

    /**
     * @var string
     */
    private $token;

    /**
     * @var string
     */
    private $language = 'en';

    /**
     * @var string
     */
    private $version = '3.0.0';

    /**
     * @throws InvalidArgumentException
     */
    public function __construct()
    {
        $this->init();
    }

    /**
     * {@inheritDoc}
     */
    public function setToken(?string $token): void
    {
        $this->token = $token;
    }

    /**
     * {@inheritDoc}
     */
    public function setLanguage(string $language): void
    {
        $this->language = $language;
    }

    /**
     * {@inheritDoc}
     */
    public function setVersion(string $version): void
    {
        $this->version = $version;
    }

    /**
     * {@inheritDoc}
     */
    public function authentication(): Extension\AuthenticationExtension
    {
        return new Extension\AuthenticationExtension($this);
    }

    /**
     * {@inheritDoc}
     */
    public function languages(): Extension\LanguagesExtension
    {
        return new Extension\LanguagesExtension($this);
    }

    /**
     * {@inheritDoc}
     */
    public function episodes(): Extension\EpisodesExtension
    {
        return new Extension\EpisodesExtension($this);
    }

    /**
     * {@inheritDoc}
     */
    public function series(): Extension\SeriesExtension
    {
        return new Extension\SeriesExtension($this);
    }

    /**
     * {@inheritDoc}
     */
    public function search(): Extension\SearchExtension
    {
        return new Extension\SearchExtension($this);
    }

    /**
     * {@inheritDoc}
     */
    public function updates(): Extension\UpdatesExtension
    {
        return new Extension\UpdatesExtension($this);
    }

    /**
     * {@inheritDoc}
     */
    public function users(): Extension\UsersExtension
    {
        return new Extension\UsersExtension($this);
    }

    /**
     * {@inheritDoc}
     */
    public function movies(): Extension\MoviesExtension
    {
        return new Extension\MoviesExtension($this);
    }

    /**
     * {@inheritDoc}
     */
    public function requestHeaders(string $method, string $path, array $options = []): array
    {
        $options = $this->getDefaultHttpClientOptions($options);

        /** @var Response $response */
        $response = $this->httpClient->{$method}($path, $options);

        return $response->getHeaders();
    }

    /**
     * {@inheritDoc}
     */
    public function performApiCallWithJsonResponse(string $method, string $path, array $options = []): string
    {
        $response = $this->performApiCall($method, $path, $options);

        if (200 === $response->getStatusCode()) {
            try {
                $contents = $response->getBody()->getContents();
            } catch (\RuntimeException $e) {
                $contents = '';
            }

            return $contents;
        }

        throw new Exception\RequestFailedException(
            sprintf(
                'Got status code %d from service at path %s',
                $response->getStatusCode(),
                $path
            )
        );
    }

    /**
     * {@inheritDoc}
     *
     * @throws Exception\ResourceNotFoundException
     */
    public function performApiCall(string $method, string $path, array $options = []): Response
    {
        $options = $this->getDefaultHttpClientOptions($options);

        /** @var Response $response */
        $response = $this->httpClient->{$method}($path, $options);

        if (401 === $response->getStatusCode()) {
            throw Exception\UnauthorizedException::invalidToken();
        }

        if (404 === $response->getStatusCode()) {
            $parameters = array_key_exists('query', $options) ? $options['query'] : [];
            throw Exception\ResourceNotFoundException::withPath($path, $parameters);
        }

        return $response;
    }

    /**
     * @throws InvalidArgumentException
     */
    protected function init(): void
    {
        $this->httpClient = new HttpClient(
            [
                'base_uri' => self::API_BASE_URI,
                'verify' => false,
                'http_errors' => false,
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
            ]
        );
    }

    private function getDefaultHttpClientOptions(array $options = []): array
    {
        $headers = [];

        if (null !== $this->token) {
            $headers['Authorization'] = 'Bearer '.$this->token;
        }

        if (null !== $this->language) {
            $headers['Accept-Language'] = $this->language;
        }

        if (null !== $this->version) {
            $headers['Accept'] = 'application/vnd.thetvdb.v'.$this->version;
        }

        return array_merge_recursive(
            [
                'headers' => $headers,
            ],
            $options
        );
    }
}
