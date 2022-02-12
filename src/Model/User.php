<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Model;

/**
 * @method string getUserName()
 * @method string getLanguage()
 * @method string getFavoritesDisplaymode()
 */
class User extends ValueObject
{
    public function getAttributes(): array
    {
        return [
            'userName',
            'language',
            'favoritesDisplaymode',
        ];
    }
}
