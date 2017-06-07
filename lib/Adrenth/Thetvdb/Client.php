<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb;

use Adrenth\Thetvdb\Exception\RequestFailedException;
use Adrenth\Thetvdb\Exception\ResourceNotFoundException;
use Adrenth\Thetvdb\Exception\UnauthorizedException;
use Adrenth\Thetvdb\Extension\AuthenticationExtension;
use Adrenth\Thetvdb\Extension\EpisodesExtension;
use Adrenth\Thetvdb\Extension\LanguagesExtension;
use Adrenth\Thetvdb\Extension\SearchExtension;
use Adrenth\Thetvdb\Extension\SeriesExtension;
use Adrenth\Thetvdb\Extension\UpdatesExtension;
use Adrenth\Thetvdb\Extension\UsersExtension;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Psr7\Response;

/**
 * Class Client
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb2
 */
class Client implements ClientInterface
{
    /**
     * Base URI
     *
     * @type string
     */
    const API_BASE_URI = 'https://api.thetvdb.com';

    /** @type HttpClient */
    private $httpClient;

    /** @type string */
    private $token;

    /** @type string */
    private $language = 'en';

    /** @type string */
    private $version = '2.1.0';

    /**
     * RestClient constructor.
     */
    public function __construct()
    {
        $this->init();
    }

    /**
     * Initialize Client
     *
     * @return void
     */
    protected function init(): void
    {
        $this->httpClient = new HttpClient(
            [
                'base_uri' => self::API_BASE_URI,
                'verify' => false,
                'http_errors' => false,
                //'proxy' => 'tcp://localhost:8080',
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function setToken(?string $token): Client
    {
        $this->token = $token;
        return $this;
    }


    /**
     * {@inheritdoc}
     */
    public function setLanguage(string $language): Client
    {
        $this->language = $language;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setVersion(string $version): Client
    {
        $this->version = $version;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function authentication(): AuthenticationExtension
    {
        return new AuthenticationExtension($this);
    }

    /**
     * {@inheritdoc}
     */
    public function languages(): LanguagesExtension
    {
        return new LanguagesExtension($this);
    }

    /**
     * {@inheritdoc}
     */
    public function episodes(): EpisodesExtension
    {
        return new EpisodesExtension($this);
    }

    /**
     * {@inheritdoc}
     */
    public function series(): SeriesExtension
    {
        return new SeriesExtension($this);
    }

    /**
     * {@inheritdoc}
     */
    public function search(): SearchExtension
    {
        return new SearchExtension($this);
    }

    /**
     * {@inheritdoc}
     */
    public function updates(): UpdatesExtension
    {
        return new UpdatesExtension($this);
    }

    /**
     * {@inheritdoc}
     */
    public function users(): UsersExtension
    {
        return new UsersExtension($this);
    }

    /**
     * {@inheritdoc}
     */
    public function requestHeaders(string $method, string $path, array $options = []): array
    {
        $options = $this->getDefaultHttpClientOptions($options);

        /** @type Response $response */
        $response = $this->httpClient->{$method}($path, $options);

        return $response->getHeaders();
    }

    /**
     * {@inheritdoc}
     */
    public function performApiCallWithJsonResponse(string $method, string $path, array $options = []): string
    {
        $response = $this->performApiCall($method, $path, $options);

        if ($response->getStatusCode() === 200) {
            try {
                $contents = $response->getBody()->getContents();
            } catch (\RuntimeException $e) {
                $contents = '';
            }

            return $contents;
        }

        throw new RequestFailedException(
            sprintf(
                'Got status code %d from service at path %s',
                $response->getStatusCode(),
                $path
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function performApiCall(string $method, string $path, array $options = []): Response
    {
        $options = $this->getDefaultHttpClientOptions($options);

        /** @type Response $response */
        $response = $this->httpClient->{$method}($path, $options);

        if ($response->getStatusCode() === 401) {
            throw UnauthorizedException::invalidToken();
        }

        if ($response->getStatusCode() === 404) {
            $parameters = array_key_exists('query', $options) ? $options['query'] : [];
            throw ResourceNotFoundException::withPath($path, $parameters);
        }

        return $response;
    }

    /**
     * @param array $options
     * @return array
     */
    private function getDefaultHttpClientOptions(array $options = []): array
    {
        $headers = [];

        if ($this->token !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->token;
        }

        if ($this->language !== null) {
            $headers['Accept-Language'] = $this->language;
        }

        if ($this->version !== null) {
            $headers['Accept'] = 'application/vnd.thetvdb.v' . $this->version;
        }

        return array_merge_recursive(
            [
                'headers' => $headers,
            ],
            $options
        );
    }
}
