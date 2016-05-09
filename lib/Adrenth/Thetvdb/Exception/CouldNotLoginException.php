<?php

namespace Adrenth\Thetvdb\Exception;

/**
 * Class CouldNotLoginException
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb\Exception
 * @author   A. Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb2
 */
class CouldNotLoginException extends \InvalidArgumentException
{
    /**
     * @return static
     */
    public static function unauthorized()
    {
        return new static('Not Authorized. Please check your API key and credentials.');
    }

    /**
     * @param int $statusCode
     * @return static
     */
    public static function failedWithStatusCode($statusCode)
    {
        return new static(sprintf('Login failed: Got status code %d from API', $statusCode));
    }

    /**
     * @return static
     */
    public static function noTokenInResponse()
    {
        return new static('Login failed: Invalid response from server, no token found.');
    }

    /**
     * @param string $message
     * @return static
     */
    public static function invalidContents($message)
    {
        return new static('Login failed: Could not read response contents: ' . $message);
    }
}
