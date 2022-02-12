<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Model;

/**
 * @method array getFavorites()
 */
class UserFavorites extends ValueObject
{
    public function getAttributes(): array
    {
        return [
            'favorites',
        ];
    }
}
