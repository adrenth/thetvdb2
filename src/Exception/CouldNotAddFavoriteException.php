<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Exception;

use InvalidArgumentException;

final class CouldNotAddFavoriteException extends InvalidArgumentException implements TheTvdbException
{
    public static function reason(string $message): CouldNotAddFavoriteException
    {
        return new self('Could not add favorite: '.$message);
    }
}
