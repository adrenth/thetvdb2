<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Exception;

/**
 * Class UnauthorizedException.
 *
 * @category Thetvdb
 *
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 *
 * @see     https://github.com/adrenth/thetvdb2
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
