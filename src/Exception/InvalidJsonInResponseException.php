<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Exception;

use RuntimeException;

final class InvalidJsonInResponseException extends RuntimeException implements TheTvdbException
{
    public static function couldNotDecodeJson(): self
    {
        return new self('Could not decode JSON data');
    }

    public static function incorrectDataStructure(): self
    {
        return new self('Incorrect data structure');
    }
}
