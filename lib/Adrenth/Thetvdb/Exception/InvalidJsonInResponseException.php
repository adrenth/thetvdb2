<?php

namespace Adrenth\Thetvdb\Exception;

/**
 * Class InvalidJsonInResponseException
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb\Exception
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb2
 */
class InvalidJsonInResponseException extends \InvalidArgumentException
{
    /**
     * @return static
     */
    public static function couldNotDecodeJson()
    {
        return new static('Could not decode JSON data');
    }

    /**
     * @return static
     */
    public static function incorrectDataStructure()
    {
        return new static('Incorrect data structure');
    }
}
