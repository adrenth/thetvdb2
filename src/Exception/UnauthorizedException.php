<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Exception;

use RuntimeException;

final class UnauthorizedException extends RuntimeException implements TheTvdbException
{
    public static function invalidToken(): UnauthorizedException
    {
        return new self('Unauthorized; please provide valid token, username or password');
    }
}
