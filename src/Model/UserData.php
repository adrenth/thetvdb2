<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Model;

use Adrenth\Thetvdb\Exception\InvalidArgumentException;
use Illuminate\Support\Collection;

/**
 * @method Collection getData()
 */
class UserData extends ValueObject
{
    public function __construct(array $values)
    {
        if (!array_key_exists('data', $values)) {
            throw InvalidArgumentException::expectedIndex('data');
        }

        parent::__construct([
            'data' => new User($values['data']),
        ]);
    }

    public function getAttributes(): array
    {
        return [
            'data',
        ];
    }
}
