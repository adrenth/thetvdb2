<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Extension;

use Adrenth\Thetvdb\ClientExtension;
use Adrenth\Thetvdb\Exception\InvalidArgumentException;
use Adrenth\Thetvdb\Exception\InvalidJsonInResponseException;
use Adrenth\Thetvdb\Exception\RequestFailedException;
use Adrenth\Thetvdb\Exception\UnauthorizedException;
use Adrenth\Thetvdb\Model\SeriesData;
use Adrenth\Thetvdb\ResponseHandler;

/**
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  MIT
 *
 * @see     https://github.com/adrenth/thetvdb2
 */
class SearchExtension extends ClientExtension
{
    private const PARAMETER_NAME = 'name';
    private const PARAMETER_IMDB_ID = 'imdbId';
    private const PARAMETER_ZAP2IT_ID = 'zap2itId';
    private const PARAMETER_SLUG = 'slug';

    /**     * Search for a series based on slug.
     *
     * @throws RequestFailedException
     * @throws UnauthorizedException
     * @throws InvalidArgumentException
     * @throws InvalidJsonInResponseException
     */
    public function seriesBySlug(string $slug): SeriesData
    {
        return $this->search(static::PARAMETER_SLUG, $slug);
    }

    /**     * Search for a series based on name.
     *
     * @throws RequestFailedException
     * @throws UnauthorizedException
     * @throws InvalidArgumentException
     * @throws InvalidJsonInResponseException
     */
    public function seriesByName(string $name): SeriesData
    {
        return $this->search(static::PARAMETER_NAME, $name);
    }

    /**     * Search for a series based on IMDb ID.
     *
     * @throws RequestFailedException
     * @throws UnauthorizedException
     * @throws InvalidArgumentException
     * @throws InvalidJsonInResponseException
     */
    public function seriesByImdbId(string $imdbId): SeriesData
    {
        return $this->search(static::PARAMETER_IMDB_ID, $imdbId);
    }

    /**     * Search for a series based on ZAP2IT ID.
     *
     * @throws RequestFailedException
     * @throws UnauthorizedException
     * @throws InvalidArgumentException
     * @throws InvalidJsonInResponseException
     */
    public function seriesByZap2itId(string $zap2itId): SeriesData
    {
        return $this->search(static::PARAMETER_ZAP2IT_ID, $zap2itId);
    }

    /**     * Search for a series based on parameter and value.
     *
     * @throws RequestFailedException
     * @throws UnauthorizedException
     * @throws InvalidArgumentException
     * @throws InvalidJsonInResponseException
     */
    private function search(string $parameter, string $value): SeriesData
    {
        $options = [
            'query' => [
                $parameter => $value,
            ],
            'http_errors' => false,
        ];

        $json = $this->client->performApiCallWithJsonResponse('get', '/search/series', $options);

        /** @var SeriesData $seriesData */
        $seriesData = ResponseHandler::create($json, ResponseHandler::METHOD_SEARCH_SERIES)->handle();

        return $seriesData;
    }
}
