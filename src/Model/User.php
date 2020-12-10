<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Model;

/**
 * Class User.
 *
 * @category Thetvdb
 *
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 *
 * @see     https://github.com/adrenth/thetvdb2
 *
 * @method string getUserName()
 * @method string getLanguage()
 * @method string getFavoritesDisplaymode()
 */
class User extends ValueObject
{
    /**
     * {@inheritDoc}
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
