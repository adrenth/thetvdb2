<?php

namespace Adrenth\Thetvdb\Model;

/**
 * Class BasicEpisode
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb\Model
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb2
 *
 * @method int getId()
 * @method int getAbsoluteNumber()
 * @method int getAiredEpisodeNumber()
 * @method int getAiredSeason()
 * @method int getDvdEpisodeNumber()
 * @method int getDvdSeason()
 * @method string getEpisodeName()
 * @method string getOverview()
 */
class BasicEpisode extends ValueObject
{
    /**
     * {@inheritdoc}
     */
    protected function getAttributes()
    {
        return [
            'id',
            'absoluteNumber',
            'airedEpisodeNumber',
            'airedSeason',
            'dvdEpisodeNumber',
            'dvdSeason',
            'episodeName',
            'overview',
            'firstAired'
        ];
    }
}
