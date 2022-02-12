<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Psr7\Response;
use InvalidArgumentException;
use RuntimeException;

class Client implements ClientInterface
{
    /**
     * Base URI.
     *
     * @var string
     */
    public const API_BASE_URI = 'https://api.thetvdb.com';

    private HttpClient $httpClient;
    private ?string $token = null;
    private string $language = 'en';
    private string $version = '3.0.0';

    /**
     * @throws InvalidArgumentException
     */
    public function __construct()
    {
        $this->init();
    }

    public function setToken(?string $token): void
    {
        $this->token = $token;
    }

    public function setLanguage(string $language): void
    {
        $this->language = $language;
    }

    public function setVersion(string $version): void
    {
        $this->version = $version;
    }

    public function authentication(): Extension\AuthenticationExtension
    {
        return new Extension\AuthenticationExtension($this);
    }

    public function languages(): Extension\LanguagesExtension
    {
        return new Extension\LanguagesExtension($this);
    }

    public function episodes(): Extension\EpisodesExtension
    {
        return new Extension\EpisodesExtension($this);
    }

    public function series(): Extension\SeriesExtension
    {
        return new Extension\SeriesExtension($this);
    }

    public function search(): Extension\SearchExtension
    {
        return new Extension\SearchExtension($this);
    }

    public function updates(): Extension\UpdatesExtension
    {
        return new Extension\UpdatesExtension($this);
    }

    public function users(): Extension\UsersExtension
    {
        return new Extension\UsersExtension($this);
    }

    public function movies(): Extension\MoviesExtension
    {
        return new Extension\MoviesExtension($this);
    }

    public function requestHeaders(string $method, string $path, array $options = []): array
    {
        $options = $this->getDefaultHttpClientOptions($options);

        /** @var Response $response */
        $response = $this->httpClient->{$method}($path, $options);

        return $response->getHeaders();
    }

    public function performApiCallWithJsonResponse(string $method, string $path, array $options = []): string
    {
        $response = $this->performApiCall($method, $path, $options);

        if ($response->getStatusCode() === 200) {
            try {
                $contents = $response->getBody()->getContents();
            } catch (RuntimeException $exception) {
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
     * @throws Exception\ResourceNotFoundException|Exception\UnauthorizedException
     */
    public function performApiCall(string $method, string $path, array $options = []): Response
    {
        $options = $this->getDefaultHttpClientOptions($options);

        /** @var Response $response */
        $response = $this->httpClient->{$method}($path, $options);

        if ($response->getStatusCode() === 401) {
            throw Exception\UnauthorizedException::invalidToken();
        }

        if ($response->getStatusCode() === 404) {
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

        if ($this->token !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->token;
        }

        $headers['Accept-Language'] = $this->language;
        $headers['Accept'] = 'application/vnd.thetvdb.v' . $this->version;

        return array_merge_recursive([
            'headers' => $headers,
        ], $options);
    }
}
