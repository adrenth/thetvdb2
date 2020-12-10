<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Model;

/**
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  MIT
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
