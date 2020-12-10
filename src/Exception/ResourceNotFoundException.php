<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Exception;

use Throwable;

/**
 * @author   A. Drenth <adrenth@gmail.com>
 * @license  MIT
 */
class ResourceNotFoundException extends InvalidArgumentException
{
    /**
     * @return static
     */
    public static function withPath(string $path, array $parameters = []): ResourceNotFoundException
    {
        try {
            $queryString = \GuzzleHttp\json_encode($parameters);
        } catch (Throwable $e) {
            $queryString = 'empty';
        }

        return new static(sprintf(
            'Resource not found at path: %s [parameters: %s]',
            $path,
            $queryString
        ));
    }
}
