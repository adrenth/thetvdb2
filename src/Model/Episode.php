<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Model;

use Adrenth\Thetvdb\Exception\InvalidArgumentException;

/**
 * Class Episode.
 *
 * @category Thetvdb
 *
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 *
 * @see     https://github.com/adrenth/thetvdb2
 *
 * @method int    getId()
 * @method int    getAiredSeason()
 * @method int    getAiredEpisodeNumber()
 * @method string getEpisodeName()
 * @method string getFirstAired()
 * @method array  getGuestStars()
 * @method string getDirector()
 * @method array  getWriters()
 * @method string getOverview()
 * @method array  getLanguage()
 * @method string getProductionCode()
 * @method string getShowUrl()
 * @method int    getLastUpdated()
 * @method string getDvdDiscid()
 * @method int    getDvdSeason()
 * @method int    getDvdEpisodeNumber()
 * @method int    getDvdChapter()
 * @method int    getAbsoluteNumber()
 * @method string getFilename()
 * @method int    getSeriesId()
 * @method int    getLastUpdatedBy()
 * @method int    getAirsAfterSeason()
 * @method int    getAirsBeforeSeason()
 * @method int    getAirsBeforeEpisode()
 * @method int    getThumbAuthor()
 * @method string getThumbAdded()
 * @method string getThumbWidth()
 * @method string getThumbHeight()
 * @method string getImdbId()
 * @method float  getSiteRating()
 */
class Episode extends ValueObject
{
    /**
     * {@inheritDoc}
     */
    public function __construct(array $values)
    {
        if (!array_key_exists('data', $values)) {
            throw InvalidArgumentException::expectedIndex('data');
        }

        parent::__construct($values['data']);
    }

    /**
     * {@inheritDoc}
     */
    protected function getAttributes(): array
    {
        return [
            'id',
            'airedSeason',
            'airedEpisodeNumber',
            'episodeName',
            'firstAired',
            'guestStars',
            'director',
            'writers',
            'overview',
            'language',
            'productionCode',
            'showUrl',
            'lastUpdated',
            'dvdDiscid',
            'dvdSeason',
            'dvdEpisodeNumber',
            'dvdChapter',
            'absoluteNumber',
            'filename',
            'seriesId',
            'lastUpdatedBy',
            'airsAfterSeason',
            'airsBeforeSeason',
            'airsBeforeEpisode',
            'thumbAuthor',
            'thumbAdded',
            'thumbWidth',
            'thumbHeight',
            'imdbId',
            'siteRating',
        ];
    }
}
