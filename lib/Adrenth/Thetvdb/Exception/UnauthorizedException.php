<?php

namespace Adrenth\Thetvdb\Exception;

/**
 * Class UnauthorizedException
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb\Exception
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb
 * @package Adrenth\Thetvdb\Exception
 */
class UnauthorizedException extends \Exception
{
    /**
     * @return static
     */
    public static function invalidToken()
    {
        return new static('Unauthorized; please provide valid token, username or password');
    }
}
