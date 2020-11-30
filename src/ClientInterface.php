<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb;

use Adrenth\Thetvdb\Exception\RequestFailedException;
use Adrenth\Thetvdb\Exception\UnauthorizedException;
use Adrenth\Thetvdb\Extension;
use GuzzleHttp\Psr7\Response;

/**
 * Interface RestClientInterface
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb2
 */
interface ClientInterface
{
    /**
     * Set authentication token
     *
     * @param string|null $token
     * @return void
     */
    public function setToken(?string $token): void;

    /**
     * Set language for this Client
     *
     * @param string $language Language abbreviation. E.g. en, nl or de.
     * @return void
     */
    public function setLanguage(string $language): void;

    /**
     * Set version for this Client
     *
     * @param string $version Version in format x.y.z
     * @return void
     */
    public function setVersion(string $version): void;

    /**
     * Get authentication extension
     *
     * @return Extension\AuthenticationExtension
     */
    public function authentication(): Extension\AuthenticationExtension;

    /**
     * Get language extension
     *
     * @return Extension\LanguagesExtension
     */
    public function languages(): Extension\LanguagesExtension;

    /**
     * Get episodes extension
     *
     * @return Extension\EpisodesExtension
     */
    public function episodes(): Extension\EpisodesExtension;

    /**
     * Get series extension
     *
     * @return Extension\SeriesExtension
     */
    public function series(): Extension\SeriesExtension;

    /**
     * Get search extension
     *
     * @return Extension\SearchExtension
     */
    public function search(): Extension\SearchExtension;

    /**
     * Get updates extension
     *
     * @return Extension\UpdatesExtension
     */
    public function updates(): Extension\UpdatesExtension;

    /**
     * Get users extension
     *
     * @return Extension\UsersExtension
     */
    public function users(): Extension\UsersExtension;

    /**
     * Get movies extension
     *
     * @return Extension\MoviesExtension
     */
    public function movies(): Extension\MoviesExtension;

    /**
     * Request HTTP headers
     *
     * @param string $method HTTP Method (post, get, put, etc.)
     * @param string $path Path
     * @param array $options HTTP Client options
     * @return array
     */
    public function requestHeaders(string $method, string $path, array $options = []): array;

    /**
     * Perform an API call
     *
     * @param string $method HTTP Method (post, get, put, etc.)
     * @param string $path Path
     * @param array $options HTTP Client options
     * @return Response
     * @throws UnauthorizedException
     */
    public function performApiCall(string $method, string $path, array $options = []): Response;

    /**
     * Perform an API call with JSON response
     *
     * @param string $method HTTP Method (post, get, put, etc.)
     * @param string $path Path
     * @param array $options HTTP Client options
     * @return string
     * @throws RequestFailedException
     * @throws UnauthorizedException
     */
    public function performApiCallWithJsonResponse(string $method, string $path, array $options = []): string;
}
