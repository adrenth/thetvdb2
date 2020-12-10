<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Model;

/**
 * Class UserFavorites.
 *
 * @category Thetvdb
 *
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
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
