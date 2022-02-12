<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Exception;

use JsonException;
use RuntimeException;

final class ResourceNotFoundException extends RuntimeException implements TheTvdbException
{
    public static function withPath(string $path, array $parameters = []): self
    {
        try {
            $queryString = json_encode($parameters, JSON_THROW_ON_ERROR);
        } catch (JsonException $throwable) {
            $queryString = 'empty';
        }

        return new self(sprintf(
            'Resource not found at path: %s [parameters: %s]',
            $path,
            $queryString
        ));
    }
}
