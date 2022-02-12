<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Model;

use Adrenth\Thetvdb\Exception\InvalidArgumentException;
use Illuminate\Support\Collection;

/**
 * @method Collection getData()
 * @method Links      getLinks()
 */
class UserRatingsData extends ValueObject
{
    public function __construct(array $values)
    {
        if (!array_key_exists('data', $values)) {
            throw InvalidArgumentException::expectedIndex('data');
        }

        if (!array_key_exists('links', $values)) {
            throw InvalidArgumentException::expectedIndex('links');
        }

        $items = [];

        foreach ((array) $values['data'] as $userRating) {
            $items[] = new UserRatings($userRating);
        }

        parent::__construct([
            'data' => new Collection($items),
            'links' => new Links($values['links']),
        ]);
    }

    public function getAttributes(): array
    {
        return [
            'data',
            'links',
        ];
    }
}
