<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Model;

/**
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  MIT
 *
 * @see     https://github.com/adrenth/thetvdb2
 *
 * @method int getFanart()
 * @method int getPoster()
 * @method int getSeason()
 * @method int getSeasonwide()
 * @method int getSeries()
 */
class SeriesImagesCount extends ValueObject
{
    /**     * {@inheritDoc}
     */
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
