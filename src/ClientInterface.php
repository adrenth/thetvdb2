<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb;

use Adrenth\Thetvdb\Exception\RequestFailedException;
use Adrenth\Thetvdb\Exception\UnauthorizedException;
use GuzzleHttp\Psr7\Response;

/** * Interface RestClientInterface.
 *
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  MIT
 *
 * @see     https://github.com/adrenth/thetvdb2
 */
interface ClientInterface
{
    /**     * Set authentication token.
     */
    public function setToken(?string $token): void;

    /**     * Set language for this Client.
     *
     * @param string $language Language abbreviation. E.g. en, nl or de.
     */
    public function setLanguage(string $language): void;

    /**     * Set version for this Client.
     *
     * @param string $version Version in format x.y.z
     */
    public function setVersion(string $version): void;

    /**     * Get authentication extension.
     */
    public function authentication(): Extension\AuthenticationExtension;

    /**     * Get language extension.
     */
    public function languages(): Extension\LanguagesExtension;

    /**     * Get episodes extension.
     */
    public function episodes(): Extension\EpisodesExtension;

    /**     * Get series extension.
     */
    public function series(): Extension\SeriesExtension;

    /**     * Get search extension.
     */
    public function search(): Extension\SearchExtension;

    /**     * Get updates extension.
     */
    public function updates(): Extension\UpdatesExtension;

    /**     * Get users extension.
     */
    public function users(): Extension\UsersExtension;

    /**     * Get movies extension.
     */
    public function movies(): Extension\MoviesExtension;

    /**     * Request HTTP headers.
     *
     * @param string $method  HTTP Method (post, get, put, etc.)
     * @param string $path    Path
     * @param array  $options HTTP Client options
     */
    public function requestHeaders(string $method, string $path, array $options = []): array;

    /**     * Perform an API call.
     *
     * @param string $method  HTTP Method (post, get, put, etc.)
     * @param string $path    Path
     * @param array  $options HTTP Client options
     *
     * @throws UnauthorizedException
     */
    public function performApiCall(string $method, string $path, array $options = []): Response;

    /**     * Perform an API call with JSON response.
     *
     * @param string $method  HTTP Method (post, get, put, etc.)
     * @param string $path    Path
     * @param array  $options HTTP Client options
     *
     * @throws RequestFailedException
     * @throws UnauthorizedException
     */
    public function performApiCallWithJsonResponse(string $method, string $path, array $options = []): string;
}
