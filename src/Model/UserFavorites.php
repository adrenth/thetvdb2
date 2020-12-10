<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Model;

/**
 * Class UserFavorites.
 *
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  MIT
 *
 * @see     https://github.com/adrenth/thetvdb2
 *
 * @method array getFavorites()
 */
class UserFavorites extends ValueObject
{
    /**
     * {@inheritDoc}
     */
    public function getAttributes(): array
    {
        return [
            'favorites',
        ];
    }
}
