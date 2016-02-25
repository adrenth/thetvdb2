<?php

namespace Adrenth\Thetvdb\Model;

/**
 * Class UserFavorites
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb\Model
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb
 *
 * @method array getFavorites()
 */
class UserFavorites extends ValueObject
{
    /**
     * {@inheritdoc}
     */
    public function getAttributes()
    {
        return [
            'favorites',
        ];
    }
}
