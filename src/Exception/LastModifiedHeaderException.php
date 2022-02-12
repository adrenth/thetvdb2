<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Exception;

use RuntimeException;

final class LastModifiedHeaderException extends RuntimeException implements TheTvdbException
{
    public static function notFound(): self
    {
        return new self('Last-Modified header not found.');
    }

    public static function invalidFormat(string $format): self
    {
        return new self(sprintf(
            'Last-Modified header contains invalid format: %s',
            $format
        ));
    }
}
