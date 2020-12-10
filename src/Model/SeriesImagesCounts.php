<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Model;

use Adrenth\Thetvdb\Exception\InvalidArgumentException;

/**
 * Class SeriesImagesCounts.
 *
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  MIT
 *
 * @see     https://github.com/adrenth/thetvdb2
 *
 * @method SeriesImagesCount getData()
 */
class SeriesImagesCounts extends ValueObject
{
    /**
     * {@inheritDoc}
     */
    public function __construct(array $values)
    {
        if (!array_key_exists('data', $values)) {
            throw InvalidArgumentException::expectedIndex('data');
        }

        parent::__construct([
            'data' => new SeriesImagesCount($values['data']),
        ]);
    }

    /**
     * {@inheritDoc}
     */
    public function getAttributes(): array
    {
        return [
            'data',
        ];
    }
}
