<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Model;

/**
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  MIT
 *
 * @see     https://github.com/adrenth/thetvdb2
 *
 * @method string getUserName()
 * @method string getLanguage()
 * @method string getFavoritesDisplaymode()
 */
class User extends ValueObject
{
    /**     * {@inheritDoc}
     */
    public function getAttributes(): array
    {
        return [
            'userName',
            'language',
            'favoritesDisplaymode',
        ];
    }
}
