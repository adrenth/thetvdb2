<?php

namespace Adrenth\Thetvdb;

use Adrenth\Thetvdb\Exception\RequestFailedException;
use Adrenth\Thetvdb\Exception\UnauthorizedException;
use Adrenth\Thetvdb\Extension\AuthenticationExtension;
use Adrenth\Thetvdb\Extension\EpisodesExtension;
use Adrenth\Thetvdb\Extension\LanguagesExtension;
use Adrenth\Thetvdb\Extension\SearchExtension;
use Adrenth\Thetvdb\Extension\SeriesExtension;
use Adrenth\Thetvdb\Extension\UpdatesExtension;
use Adrenth\Thetvdb\Extension\UsersExtension;
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
     * @param string $token
     * @return $this
     */
    public function setToken($token);

    /**
     * Set language for this Client
     *
     * @param string $language Language abbreviation. E.g. en, nl or de.
     * @return $this
     */
    public function setLanguage($language);

    /**
     * Set version for this Client
     *
     * @param string $version Version in format x.y.z
     * @return $this
     */
    public function setVersion($version);

    /**
     * Get authentication extension
     *
     * @return AuthenticationExtension
     */
    public function authentication();

    /**
     * Get language extension
     *
     * @return LanguagesExtension
     */
    public function languages();

    /**
     * Get episodes extension
     *
     * @return EpisodesExtension
     */
    public function episodes();

    /**
     * Get series extension
     *
     * @return SeriesExtension
     */
    public function series();

    /**
     * Get search extension
     *
     * @return SearchExtension
     */
    public function search();

    /**
     * Get updates extension
     *
     * @return UpdatesExtension
     */
    public function updates();

    /**
     * Get users extension
     *
     * @return UsersExtension
     */
    public function users();

    /**
     * Request HTTP headers
     *
     * @param string $method HTTP Method (post, get, put, etc.)
     * @param string $path Path
     * @param array $options HTTP Client options
     * @return array
     */
    public function requestHeaders($method, $path, array $options = []);

    /**
     * Perform an API call
     *
     * @param string $method HTTP Method (post, get, put, etc.)
     * @param string $path Path
     * @param array $options HTTP Client options
     * @return Response
     * @throws UnauthorizedException
     */
    public function performApiCall($method, $path, array $options = []);

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
    public function performApiCallWithJsonResponse($method, $path, array $options = []);
}
