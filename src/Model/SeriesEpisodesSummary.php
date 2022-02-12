<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Model;

/**
 * @method array getAiredSeasons()
 * @method int   getAiredEpisodes()
 * @method array getDvdSeasons()
 * @method int   getDvdEpisodes()
 */
class SeriesEpisodesSummary extends ValueObject
{
    protected function getAttributes(): array
    {
        return [
            'airedSeasons',
            'airedEpisodes',
            'dvdSeasons',
            'dvdEpisodes',
        ];
    }
}
