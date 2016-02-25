<?php

namespace Adrenth\Thetvdb\Exception;

/**
 * Class InvalidArgumentException
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb\Exception
 * @author   A. Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb2
 */
class InvalidArgumentException extends \InvalidArgumentException
{
    /**
     * @param string $index
     * @return static
     */
    public static function expectedIndex($index)
    {
        return new static(sprintf(
            'Expected index %s not found',
            $index
        ));
    }

    /**
     * @param string $attribute
     * @param string $class
     * @return static
     */
    public static function undefinedAttribute($attribute, $class)
    {
        return new static(sprintf(
            'Undefined attribute %s in class %s',
            $attribute,
            $class
        ));
    }

    /**
     * @param string $attribute
     * @param string $class
     * @return static
     */
    public static function noValueForAttribute($attribute, $class)
    {
        return new static(sprintf(
            'No value for attribute %s found in class %s',
            $attribute,
            $class
        ));
    }

    /**
     * @param string $method
     * @param array $availableMethods
     * @return static
     */
    public static function invalidMethod($method, array $availableMethods)
    {
        return new static(sprintf(
            'Invalid method %s, use one of these instead: %s',
            $method,
            implode(', ', $availableMethods)
        ));
    }
}
