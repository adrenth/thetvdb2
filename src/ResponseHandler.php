<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb;

use Adrenth\Thetvdb\Exception\InvalidArgumentException;
use Adrenth\Thetvdb\Exception\InvalidJsonInResponseException;

/**
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  MIT
 *
 * @see     https://github.com/adrenth/thetvdb2
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
    public const METHOD_MOVIE = 'movie';
    public const METHOD_UPDATED_MOVIES = 'updatedMovies';

    /**
     * @var string
     */
    protected $json;

    /**
     * @var string
     */
    protected $method;

    /**
     * @var array
     */
    private static $mapping = [
        self::METHOD_SERIES => Model\Series::class,
        self::METHOD_EPISODE => Model\Episode::class,
        self::METHOD_SERIES_ACTORS => Model\SeriesActors::class,
        self::METHOD_SERIES_EPISODES => Model\SeriesEpisodes::class,
        self::METHOD_SERIES_EPISODES_QUERY => Model\SeriesEpisodesQuery::class,
        self::METHOD_SERIES_EPISODES_QUERY_PARAMS => Model\SeriesEpisodesQueryParams::class,
        self::METHOD_SERIES_EPISODES_SUMMARY => Model\SeriesEpisodesSummary::class,
        self::METHOD_SERIES_FILTER => Model\Series::class,
        self::METHOD_SERIES_FILTER_PARAMS => Model\FilterKeys::class,
        self::METHOD_SERIES_IMAGES => Model\SeriesImagesCounts::class,
        self::METHOD_SERIES_IMAGES_QUERY_PARAMS => Model\SeriesImagesQueryParams::class,
        self::METHOD_SERIES_IMAGES_QUERY => Model\SeriesImageQueryResults::class,
        self::METHOD_LANGUAGES => Model\LanguageData::class,
        self::METHOD_LANGUAGE => Model\Language::class,
        self::METHOD_SEARCH_SERIES => Model\SeriesData::class,
        self::METHOD_UPDATES => Model\UpdateData::class,
        self::METHOD_USER => Model\UserData::class,
        self::METHOD_USER_FAVORITES => Model\UserFavoritesData::class,
        self::METHOD_USER_RATINGS => Model\UserRatingsData::class,
        self::METHOD_USER_RATINGS_ADD => Model\UserRatingsDataNoLinks::class,
        self::METHOD_MOVIE => Model\Movie::class,
        self::METHOD_UPDATED_MOVIES => Model\UpdatedMovies::class,
    ];

    /**
     * Construct.
     *
     * @param string $json   JSON data
     * @param string $method Method
     *
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
     * @param string $json   JSON data
     * @param string $method Method
     *
     * @return static
     *
     * @throws InvalidArgumentException
     */
    public static function create(string $json, string $method): ResponseHandler
    {
        return new static($json, $method);
    }

    /**
     * {@inheritDoc}
     *
     * @throws InvalidJsonInResponseException
     */
    public function handle(): Model\ValueObject
    {
        $data = $this->getData();
        $class = self::$mapping[$this->method];

        return new $class($data);
    }

    /**
     * @throws InvalidJsonInResponseException
     */
    public function getData(): array
    {
        $data = json_decode($this->json, true);

        if (null === $data || false === $data) {
            throw InvalidJsonInResponseException::couldNotDecodeJson();
        }

        return $data;
    }

    private function isValidMethod(string $method): bool
    {
        return array_key_exists($method, self::$mapping);
    }
}
