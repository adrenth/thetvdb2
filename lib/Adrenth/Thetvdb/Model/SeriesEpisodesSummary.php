<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Model;

/**
 * Class SeriesEpisodesSummary
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb\Model
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb2
 *
 * @method array getAiredSeasons()
 * @method int getAiredEpisodes()
 * @method array getDvdSeasons()
 * @method int getDvdEpisodes()
 */
class SeriesEpisodesSummary extends ValueObject
{
    /**
     * {@inheritdoc}
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
