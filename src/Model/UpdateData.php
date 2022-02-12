<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Model;

use Adrenth\Thetvdb\Exception\InvalidArgumentException;
use Illuminate\Support\Collection;

/**
 * @method Collection getData()
 */
class UpdateData extends ValueObject
{
    public function __construct(array $values)
    {
        if (!array_key_exists('data', $values)) {
            throw InvalidArgumentException::expectedIndex('data');
        }

        $items = [];

        foreach ((array) $values['data'] as $update) {
            $items[] = new Update($update);
        }

        parent::__construct([
            'data' => new Collection($items),
        ]);
    }

    public function getAttributes(): array
    {
        return [
            'data',
        ];
    }
}
