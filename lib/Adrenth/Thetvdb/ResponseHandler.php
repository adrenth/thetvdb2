<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb;

use Adrenth\Thetvdb\Exception\InvalidArgumentException;
use Adrenth\Thetvdb\Exception\InvalidJsonInResponseException;
use Adrenth\Thetvdb\Model\Episode;
use Adrenth\Thetvdb\Model\FilterKeys;
use Adrenth\Thetvdb\Model\Language;
use Adrenth\Thetvdb\Model\LanguageData;
use Adrenth\Thetvdb\Model\Series;
use Adrenth\Thetvdb\Model\SeriesData;
use Adrenth\Thetvdb\Model\SeriesActors;
use Adrenth\Thetvdb\Model\SeriesEpisodes;
use Adrenth\Thetvdb\Model\SeriesEpisodesQuery;
use Adrenth\Thetvdb\Model\SeriesEpisodesQueryParams;
use Adrenth\Thetvdb\Model\SeriesEpisodesSummary;
use Adrenth\Thetvdb\Model\SeriesImageQueryResults;
use Adrenth\Thetvdb\Model\SeriesImagesCounts;
use Adrenth\Thetvdb\Model\SeriesImagesQueryParams;
use Adrenth\Thetvdb\Model\UpdateData;
use Adrenth\Thetvdb\Model\UserData;
use Adrenth\Thetvdb\Model\UserFavoritesData;
use Adrenth\Thetvdb\Model\UserRatingsData;
use Adrenth\Thetvdb\Model\UserRatingsDataNoLinks;

/**
 * Class JsonResponseHandler
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb2
 */
class ResponseHandler implements ResponseHandlerInterface
{
    const METHOD_SERIES = 'series';
    const METHOD_EPISODE = 'episode';
    const METHOD_SERIES_ACTORS = 'seriesActors';
    const METHOD_SERIES_EPISODES = 'seriesEpisodes';
    const METHOD_SERIES_EPISODES_QUERY = 'seriesEpisodesQuery';
    const METHOD_SERIES_EPISODES_QUERY_PARAMS = 'seriesEpisodesQueryParams';
    const METHOD_SERIES_EPISODES_SUMMARY = 'seriesEpisodesSummary';
    const METHOD_SERIES_FILTER = 'seriesFilter';
    const METHOD_SERIES_FILTER_PARAMS = 'seriesFilterParams';
    const METHOD_SERIES_IMAGES = 'seriesImages';
    const METHOD_SERIES_IMAGES_QUERY = 'seriesImagesQuery';
    const METHOD_SERIES_IMAGES_QUERY_PARAMS = 'seriesImagesQueryParams';
    const METHOD_LANGUAGES = 'languages';
    const METHOD_LANGUAGE = 'language';
    const METHOD_SEARCH_SERIES = 'searchSeries';
    const METHOD_UPDATES = 'updates';
    const METHOD_USER = 'user';
    const METHOD_USER_FAVORITES = 'userFavorites';
    const METHOD_USER_RATINGS = 'userRatings';
    const METHOD_USER_RATINGS_ADD = 'userRatingsAdd';

    /** @type array */
    private static $mapping = [
        self::METHOD_SERIES => Series::class,
        self::METHOD_EPISODE => Episode::class,
        self::METHOD_SERIES_ACTORS => SeriesActors::class,
        self::METHOD_SERIES_EPISODES => SeriesEpisodes::class,
        self::METHOD_SERIES_EPISODES_QUERY => SeriesEpisodesQuery::class,
        self::METHOD_SERIES_EPISODES_QUERY_PARAMS => SeriesEpisodesQueryParams::class,
        self::METHOD_SERIES_EPISODES_SUMMARY => SeriesEpisodesSummary::class,
        self::METHOD_SERIES_FILTER => Series::class,
        self::METHOD_SERIES_FILTER_PARAMS => FilterKeys::class,
        self::METHOD_SERIES_IMAGES => SeriesImagesCounts::class,
        self::METHOD_SERIES_IMAGES_QUERY_PARAMS => SeriesImagesQueryParams::class,
        self::METHOD_SERIES_IMAGES_QUERY => SeriesImageQueryResults::class,
        self::METHOD_LANGUAGES => LanguageData::class,
        self::METHOD_LANGUAGE => Language::class,
        self::METHOD_SEARCH_SERIES => SeriesData::class,
        self::METHOD_UPDATES => UpdateData::class,
        self::METHOD_USER => UserData::class,
        self::METHOD_USER_FAVORITES => UserFavoritesData::class,
        self::METHOD_USER_RATINGS => UserRatingsData::class,
        self::METHOD_USER_RATINGS_ADD => UserRatingsDataNoLinks::class,
    ];

     /* @type string */
    protected $json;

    /** @type string */
    protected $method;

    /**
     * Construct
     *
     * @param string $json JSON data
     * @param string $method Method
     * @throws InvalidArgumentException
     */
    public function __construct(string $json, string $method)
    {
        $this->json = $json;

        if (!$this->isValidMethod($method)) {
            throw InvalidArgumentException::invalidMethod($method, self::$mapping);
        }

        $this->method = $method;
    }

    /**
     * @param string $json JSON data
     * @param string $method Method
     * @return static
     * @throws InvalidArgumentException
     */
    public static function create(string $json, string $method)
    {
        return new static($json, $method);
    }

    /**
     * {@inheritdoc}
     * @throws InvalidJsonInResponseException
     */
    public function handle()
    {
        $data = $this->getData();
        $class = self::$mapping[$this->method];
        return new $class($data);
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        $data = json_decode($this->json, true);

        if ($data === null) {
            throw InvalidJsonInResponseException::couldNotDecodeJson();
        }

        return $data;
    }

    /**
     * @param string $method
     * @return bool
     */
    private function isValidMethod(string $method): bool
    {
        return array_key_exists($method, self::$mapping);
    }
}
