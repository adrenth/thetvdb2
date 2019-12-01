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
use Adrenth\Thetvdb\Model\SeriesActors;
use Adrenth\Thetvdb\Model\SeriesData;
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
use Adrenth\Thetvdb\Model\ValueObject;

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
    public const METHOD_SERIES = 'series';
    public const METHOD_EPISODE = 'episode';
    public const METHOD_SERIES_ACTORS = 'seriesActors';
    public const METHOD_SERIES_EPISODES = 'seriesEpisodes';
    public const METHOD_SERIES_EPISODES_QUERY = 'seriesEpisodesQuery';
    public const METHOD_SERIES_EPISODES_QUERY_PARAMS = 'seriesEpisodesQueryParams';
    public const METHOD_SERIES_EPISODES_SUMMARY = 'seriesEpisodesSummary';
    public const METHOD_SERIES_FILTER = 'seriesFilter';
    public const METHOD_SERIES_FILTER_PARAMS = 'seriesFilterParams';
    public const METHOD_SERIES_IMAGES = 'seriesImages';
    public const METHOD_SERIES_IMAGES_QUERY = 'seriesImagesQuery';
    public const METHOD_SERIES_IMAGES_QUERY_PARAMS = 'seriesImagesQueryParams';
    public const METHOD_LANGUAGES = 'languages';
    public const METHOD_LANGUAGE = 'language';
    public const METHOD_SEARCH_SERIES = 'searchSeries';
    public const METHOD_UPDATES = 'updates';
    public const METHOD_USER = 'user';
    public const METHOD_USER_FAVORITES = 'userFavorites';
    public const METHOD_USER_RATINGS = 'userRatings';
    public const METHOD_USER_RATINGS_ADD = 'userRatingsAdd';

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
    public function handle(): ValueObject
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
