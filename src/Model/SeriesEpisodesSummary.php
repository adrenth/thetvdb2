<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Model;

/**
 * @author   Alwin Drenth <adrenth@gmail.com>
 *
 * @method array getAiredSeasons()
 * @method int   getAiredEpisodes()
 * @method array getDvdSeasons()
 * @method int   getDvdEpisodes()
 */
class SeriesEpisodesSummary extends ValueObject
{
    /**
     * {@inheritDoc}
     */
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
