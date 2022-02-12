<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Exception;

use RuntimeException;

final class CouldNotLoginException extends RuntimeException implements TheTvdbException
{
    public static function unauthorized(): self
    {
        return new self('Not Authorized. Please check your API key and credentials.');
    }

    public static function failedWithStatusCode(int $statusCode): self
    {
        return new self(sprintf('Login failed: Got status code %d from API', $statusCode));
    }

    public static function noTokenInResponse(): self
    {
        return new self('Login failed: Invalid response from server, no token found.');
    }

    public static function invalidContents(string $message): self
    {
        return new self('Login failed: Could not read response contents: ' . $message);
    }

    public static function withReason(string $message): self
    {
        return new self('Login failed: ' . $message);
    }
}
