<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Model;

use Adrenth\Thetvdb\Exception\InvalidArgumentException;

/**
 * @method UserFavorites getData()
 */
class UserFavoritesData extends ValueObject
{
    public function __construct(array $values)
    {
        if (!array_key_exists('data', $values)) {
            throw InvalidArgumentException::expectedIndex('data');
        }

        parent::__construct([
            'data' => new UserFavorites($values['data']),
        ]);
    }

    public function getAttributes(): array
    {
        return [
            'data',
        ];
    }
}
