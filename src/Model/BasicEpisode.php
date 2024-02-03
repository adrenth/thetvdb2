<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Model;

/**
 * @method int    getId()
 * @method int    getAbsoluteNumber()
 * @method int    getAiredEpisodeNumber()
 * @method int    getAiredSeason()
 * @method int    getAiredSeasonID()
 * @method int    getDvdEpisodeNumber()
 * @method int    getDvdSeason()
 * @method string getEpisodeName()
 * @method string getOverview()
 * @method string getFirstAired()
 * @method int    getLastUpdated()
 */
class BasicEpisode extends ValueObject
{
    protected function getAttributes(): array
    {
        return [
            'id',
            'absoluteNumber',
            'airedEpisodeNumber',
            'airedSeason',
            'airedSeasonID',
            'dvdEpisodeNumber',
            'dvdSeason',
            'episodeName',
            'overview',
            'firstAired',
            'lastUpdated',
        ];
    }
}
