<?php

namespace Adrenth\Thetvdb\Model;

/**
 * Class User
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb\Model
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb2
 *
 * @method string getUserName()
 * @method string getLanguage()
 * @method string getFavoritesDisplaymode()
 */
class User extends ValueObject
{
    /**
     * {@inheritdoc}
     */
    public function getAttributes()
    {
        return [
            'userName',
            'language',
            'favoritesDisplaymode',
        ];
    }
}
