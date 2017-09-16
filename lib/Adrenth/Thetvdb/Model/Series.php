<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Model;

use Adrenth\Thetvdb\Exception\InvalidArgumentException;

/**
 * Class Series
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb\Model
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb2
 *
 * @method int getId()
 * @method string getSeriesName()
 * @method array getAliases()
 * @method string getBanner()
 * @method string getSeriesId()
 * @method string getStatus()
 * @method string getFirstAired()
 * @method string getNetwork()
 * @method string getNetworkId()
 * @method string getRuntime()
 * @method array getGenre()
 * @method string getOverview()
 * @method int getLastUpdated()
 * @method string getAirsDayOfWeek()
 * @method string getAirsTime()
 * @method string getRating()
 * @method string getImdbId()
 * @method string getZap2itId()
 * @method string getAdded()
 * @method int getAddedBy()
 * @method float getSiteRating()
 * @method int getSiteRatingCount()
 */
class Series extends ValueObject
{
    /**
     * {@inheritdoc}
     */
    public function __construct(array $values)
    {
        if (!array_key_exists('data', $values)) {
            throw InvalidArgumentException::expectedIndex('data');
        }

        parent::__construct($values['data']);
    }

    /**
     * {@inheritdoc}
     */
    public function getAttributes(): array
    {
        return [
            'id',
            'seriesName',
            'aliases',
            'banner',
            'seriesId',
            'status',
            'firstAired',
            'network',
            'networkId',
            'runtime',
            'genre',
            'overview',
            'lastUpdated',
            'airsDayOfWeek',
            'airsTime',
            'rating',
            'imdbId',
            'zap2itId',
            'added',
            'addedBy',
            'siteRating',
            'siteRatingCount'
        ];
    }
}
