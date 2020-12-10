<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Exception;

use InvalidArgumentException;

/**
 * Class CouldNotAddFavoriteException.
 *
 * @category Thetvdb
 *
 * @author   A. Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 *
 * @see     https://github.com/adrenth/thetvdb2
 */
class CouldNotAddFavoriteException extends InvalidArgumentException
{
    /**
     * @return static
     */
    public static function reason(string $message): CouldNotAddFavoriteException
    {
        return new static('Could not add favorite: '.$message);
    }
}
