<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Exception;

use InvalidArgumentException;

/**
 * @author   A. Drenth <adrenth@gmail.com>
 * @license  MIT
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
