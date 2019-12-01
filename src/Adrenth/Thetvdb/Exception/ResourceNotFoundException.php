<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Exception;

use Throwable;

/**
 * Class ResourceNotFoundException
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb\Exception
 * @author   A. Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb2
 */
class ResourceNotFoundException extends InvalidArgumentException
{
    /**
     * @param string $path
     * @param array $parameters
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
