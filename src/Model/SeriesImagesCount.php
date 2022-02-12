<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Model;

/**
 * @method int getFanart()
 * @method int getPoster()
 * @method int getSeason()
 * @method int getSeasonwide()
 * @method int getSeries()
 */
class SeriesImagesCount extends ValueObject
{
    public function getAttributes(): array
    {
        return [
            'fanart',
            'poster',
            'season',
            'seasonwide',
            'series',
        ];
    }
}
