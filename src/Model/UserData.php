<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Model;

use Adrenth\Thetvdb\Exception\InvalidArgumentException;
use Illuminate\Support\Collection;

/**
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  MIT
 *
 * @method Collection getData()
 */
class UserData extends ValueObject
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
            'data' => new User($values['data']),
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
