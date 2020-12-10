<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Exception;

/**
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  MIT
 */
class UnauthorizedException extends \Exception
{
    /**
     * @return static
     */
    public static function invalidToken(): UnauthorizedException
    {
        return new static('Unauthorized; please provide valid token, username or password');
    }
}
