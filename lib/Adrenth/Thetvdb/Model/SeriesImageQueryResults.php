<?php

namespace Adrenth\Thetvdb\Model;

use Adrenth\Thetvdb\Exception\InvalidArgumentException;
use Illuminate\Support\Collection;

/**
 * Class SeriesImageQueryResults
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb\Model
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb2
 *
 * @method Collection getData()
 */
class SeriesImageQueryResults extends ValueObject
{
    /**
     * {@inheritdoc}
     */
    public function __construct(array $values)
    {
        if (!array_key_exists('data', $values)) {
            throw InvalidArgumentException::expectedIndex('data');
        }

        $items = [];

        foreach ($values['data'] as $seriesImageQueryResult) {
            $items[] = new SeriesImageQueryResult($seriesImageQueryResult);
        }

        parent::__construct([
            'data' => new Collection($items)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getAttributes()
    {
        return [
            'data',
        ];
    }
}
