<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Model;

use Adrenth\Thetvdb\Exception\InvalidArgumentException;
use Illuminate\Support\Collection;

/**
 * @method Collection getData()
 */
class FilterKeys extends ValueObject
{
    public function __construct(array $values)
    {
        if (!array_key_exists('data', $values)) {
            throw InvalidArgumentException::expectedIndex('data');
        }

        if (!array_key_exists('params', $values['data'])) {
            throw InvalidArgumentException::expectedIndex('params');
        }

        parent::__construct([
            'data' => new Collection($values['data']['params']),
        ]);
    }

    public function getAttributes(): array
    {
        return [
            'data',
        ];
    }
}
