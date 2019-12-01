<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Extension;

use Adrenth\Thetvdb\ClientExtension;
use Adrenth\Thetvdb\Exception\InvalidArgumentException;
use Adrenth\Thetvdb\Exception\InvalidJsonInResponseException;
use Adrenth\Thetvdb\Exception\LastModifiedHeaderException;
use Adrenth\Thetvdb\Exception\RequestFailedException;
use Adrenth\Thetvdb\Exception\UnauthorizedException;
use Adrenth\Thetvdb\Model\FilterKeys;
use Adrenth\Thetvdb\Model\Series;
use Adrenth\Thetvdb\Model\SeriesActors;
use Adrenth\Thetvdb\Model\SeriesEpisodes;
use Adrenth\Thetvdb\Model\SeriesEpisodesQuery;
use Adrenth\Thetvdb\Model\SeriesEpisodesQueryParams;
use Adrenth\Thetvdb\Model\SeriesEpisodesSummary;
use Adrenth\Thetvdb\Model\SeriesImageQueryResults;
use Adrenth\Thetvdb\Model\SeriesImagesCounts;
use Adrenth\Thetvdb\Model\SeriesImagesQueryParams;
use Adrenth\Thetvdb\ResponseHandler;
use DateTimeImmutable;

/**
 * Class SeriesExtension
 *
 * Information about a specific series
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb\Extension
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb2
 */
class SeriesExtension extends ClientExtension
{
    /**
     * Returns a series record that contains all information known about a particular series ID.
     *
     * @param int $seriesId
     * @return Series
     * @throws RequestFailedException
     * @throws UnauthorizedException
     * @throws InvalidJsonInResponseException
     * @throws InvalidArgumentException
     */
    public function get(int $seriesId): Series
    {
        $json = $this->client->performApiCallWithJsonResponse('get', '/series/' . (int) $seriesId);
        return ResponseHandler::create($json, ResponseHandler::METHOD_SERIES)->handle();
    }

    /**
     * Returns actors for the given series ID.
     *
     * @param int $seriesId
     * @return SeriesActors
     * @throws RequestFailedException
     * @throws UnauthorizedException
     * @throws InvalidJsonInResponseException
     * @throws InvalidArgumentException
     */
    public function getActors(int $seriesId): SeriesActors
    {
        $json = $this->client->performApiCallWithJsonResponse('get', sprintf('/series/%d/actors', (int) $seriesId));
        return ResponseHandler::create($json, ResponseHandler::METHOD_SERIES_ACTORS)->handle();
    }

    /**
     * All episodes for a given series. Paginated with 100 results per page.
     *
     * @param int $seriesId
     * @param int|null $page
     * @return SeriesEpisodes
     * @throws RequestFailedException
     * @throws UnauthorizedException
     * @throws InvalidJsonInResponseException
     * @throws InvalidArgumentException
     */
    public function getEpisodes(int $seriesId, int $page = null): SeriesEpisodes
    {
        $options = [
            'query' => [
                'page' => $page === null ? 1 : (int) $page,
            ],
        ];

        $json = $this->client->performApiCallWithJsonResponse(
            'get',
            sprintf('/series/%d/episodes', (int) $seriesId),
            $options
        );

        return ResponseHandler::create($json, ResponseHandler::METHOD_SERIES_EPISODES)->handle();
    }

    /**
     * @param int $seriesId
     * @return SeriesEpisodesQueryParams
     * @throws RequestFailedException
     * @throws UnauthorizedException
     * @throws InvalidJsonInResponseException
     * @throws InvalidArgumentException
     */
    public function getEpisodesQueryParams(int $seriesId): SeriesEpisodesQueryParams
    {
        $json = $this->client->performApiCallWithJsonResponse(
            'get',
            sprintf('/series/%d/episodes/query/params', (int) $seriesId)
        );

        return ResponseHandler::create($json, ResponseHandler::METHOD_SERIES_EPISODES_QUERY_PARAMS)->handle();
    }

    /**
     * @param $seriesId
     * @param array $query
     * @return SeriesEpisodesQuery
     * @throws RequestFailedException
     * @throws UnauthorizedException
     * @throws InvalidJsonInResponseException
     * @throws InvalidArgumentException
     */
    public function getEpisodesWithQuery(int $seriesId, array $query): SeriesEpisodesQuery
    {
        $options = ['query' => $query];

        $json = $this->client->performApiCallWithJsonResponse(
            'get',
            sprintf('/series/%d/episodes/query', (int) $seriesId),
            $options
        );

        return ResponseHandler::create($json, ResponseHandler::METHOD_SERIES_EPISODES_QUERY)->handle();
    }

    /**
     * @param int $seriesId
     * @return SeriesEpisodesSummary
     * @throws RequestFailedException
     * @throws UnauthorizedException
     * @throws InvalidJsonInResponseException
     * @throws InvalidArgumentException
     */
    public function getEpisodesSummary(int $seriesId): SeriesEpisodesSummary
    {
        $json = $this->client->performApiCallWithJsonResponse(
            'get',
            sprintf('/series/%d/episodes/summary', (int) $seriesId)
        );

        return ResponseHandler::create($json, ResponseHandler::METHOD_SERIES_EPISODES_SUMMARY)->handle();
    }

    /**
     * @param int $seriesId
     * @return FilterKeys
     * @throws RequestFailedException
     * @throws UnauthorizedException
     * @throws InvalidJsonInResponseException
     * @throws InvalidArgumentException
     */
    public function getFilterParams(int $seriesId): FilterKeys
    {
        $json = $this->client->performApiCallWithJsonResponse(
            'get',
            sprintf('/series/%d/filter/params', (int) $seriesId)
        );

        return ResponseHandler::create($json, ResponseHandler::METHOD_SERIES_FILTER_PARAMS)->handle();
    }

    /**
     * @param int $seriesId
     * @param array $keys
     * @return Series
     * @throws RequestFailedException
     * @throws UnauthorizedException
     * @throws InvalidJsonInResponseException
     * @throws InvalidArgumentException
     */
    public function getWithFilter(int $seriesId, array $keys): Series
    {
        $options = [
            'query' => [
                'keys' => implode(',', $keys)
            ]
        ];

        $json = $this->client->performApiCallWithJsonResponse(
            'get',
            sprintf('/series/%d/filter', (int) $seriesId),
            $options
        );

        return ResponseHandler::create($json, ResponseHandler::METHOD_SERIES_FILTER)->handle();
    }

    /**
     * @param int $seriesId
     * @return SeriesImagesCounts
     * @throws RequestFailedException
     * @throws UnauthorizedException
     * @throws InvalidJsonInResponseException
     * @throws InvalidArgumentException
     */
    public function getImages(int $seriesId): SeriesImagesCounts
    {
        $json = $this->client->performApiCallWithJsonResponse(
            'get',
            sprintf('/series/%d/images', (int) $seriesId)
        );

        return ResponseHandler::create($json, ResponseHandler::METHOD_SERIES_IMAGES)->handle();
    }

    /**
     * @param int $seriesId
     * @return SeriesImagesQueryParams
     * @throws RequestFailedException
     * @throws UnauthorizedException
     * @throws InvalidJsonInResponseException
     * @throws InvalidArgumentException
     */
    public function getImagesQueryParams(int $seriesId): SeriesImagesQueryParams
    {
        $json = $this->client->performApiCallWithJsonResponse(
            'get',
            sprintf('/series/%d/images/query/params', (int) $seriesId)
        );

        return ResponseHandler::create($json, ResponseHandler::METHOD_SERIES_IMAGES_QUERY_PARAMS)->handle();
    }

    /**
     * E.g.: $query = [
     *      'keyType' => 'fanart',
     *      'resolution' => '1920x1080',
     *      'subKey' => 'graphical'
     * ]
     *
     * @param int $seriesId
     * @param array $query
     * @return SeriesImageQueryResults
     * @throws RequestFailedException
     * @throws UnauthorizedException
     * @throws InvalidJsonInResponseException
     * @throws InvalidArgumentException
     */
    public function getImagesWithQuery(int $seriesId, array $query): SeriesImageQueryResults
    {
        $options = [
            'query' => $query
        ];

        $json = $this->client->performApiCallWithJsonResponse(
            'get',
            sprintf('/series/%d/images/query', (int) $seriesId),
            $options
        );

        return ResponseHandler::create($json, ResponseHandler::METHOD_SERIES_IMAGES_QUERY)->handle();
    }

    /**
     * @param int $seriesId
     * @return DateTimeImmutable
     * @throws LastModifiedHeaderException
     */
    public function getLastModified(int $seriesId): DateTimeImmutable
    {
        $headers = $this->client->requestHeaders('head', sprintf('/series/%d', (int) $seriesId));

        if (array_key_exists('Last-Modified', $headers)
            && array_key_exists(0, $headers['Last-Modified'])) {
            $lastModified = DateTimeImmutable::createFromFormat(
                'D, d M Y H:i:s e',
                $headers['Last-Modified'][0]
            );

            if ($lastModified === false) {
                throw LastModifiedHeaderException::invalidFormat($headers['Last-Modified'][0]);
            }

            return $lastModified;
        }

        throw LastModifiedHeaderException::notFound();
    }
}
