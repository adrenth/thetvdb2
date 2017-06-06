<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Model;

/**
 * Class SeriesImagesCount
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb\Model
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb2
 *
 * @method int getFanart()
 * @method int getPoster()
 * @method int getSeason()
 * @method int getSeasonwide()
 * @method int getSeries()
 */
class SeriesImagesCount extends ValueObject
{
    /**
     * {@inheritdoc}
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
