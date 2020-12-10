<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Exception;

/**
 * Class InvalidArgumentException.
 *
 * @author   A. Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 *
 * @see     https://github.com/adrenth/thetvdb2
 */
class InvalidArgumentException extends \InvalidArgumentException
{
    /**
     * @return static
     */
    public static function expectedIndex(string $index): InvalidArgumentException
    {
        return new static(sprintf(
            'Expected index %s not found',
            $index
        ));
    }

    /**
     * @return static
     */
    public static function undefinedAttribute(string $attribute, string $class): InvalidArgumentException
    {
        return new static(sprintf(
            'Undefined attribute %s in class %s',
            $attribute,
            $class
        ));
    }

    /**
     * @return static
     */
    public static function noValueForAttribute(string $attribute, string $class): InvalidArgumentException
    {
        return new static(sprintf(
            'No value for attribute %s found in class %s',
            $attribute,
            $class
        ));
    }

    /**
     * @return static
     */
    public static function invalidMethod(string $method, array $availableMethods): InvalidArgumentException
    {
        return new static(sprintf(
            'Invalid method %s, use one of these instead: %s',
            $method,
            implode(', ', $availableMethods)
        ));
    }
}
