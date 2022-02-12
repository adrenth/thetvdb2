<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Exception;

use RuntimeException;

final class CouldNotAddOrUpdateUserRatingException extends RuntimeException implements TheTvdbException
{
    public static function reason(string $message): CouldNotAddOrUpdateUserRatingException
    {
        return new self('Could not add rating: '.$message);
    }
}
