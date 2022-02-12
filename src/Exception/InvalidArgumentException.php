<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Exception;

use InvalidArgumentException as InvalidArgumentExceptionBase;

final class InvalidArgumentException extends InvalidArgumentExceptionBase implements TheTvdbException
{
    public static function expectedIndex(string $index): self
    {
        return new self(sprintf(
            'Expected index %s not found',
            $index
        ));
    }

    public static function undefinedAttribute(string $attribute, string $class): self
    {
        return new self(sprintf(
            'Undefined attribute %s in class %s',
            $attribute,
            $class
        ));
    }

    public static function noValueForAttribute(string $attribute, string $class): self
    {
        return new self(sprintf(
            'No value for attribute %s found in class %s',
            $attribute,
            $class
        ));
    }

    public static function invalidMethod(string $method, array $availableMethods): self
    {
        return new self(sprintf(
            'Invalid method %s, use one of these instead: %s',
            $method,
            implode(', ', $availableMethods)
        ));
    }
}
