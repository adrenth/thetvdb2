<?php

namespace Adrenth\Thetvdb\Exception;

/**
 * Class ResourceNotFoundException
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb\Exception
 * @author   A. Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb
 */
class ResourceNotFoundException extends InvalidArgumentException
{
    /**
     * @param string $path
     * @param array $parameters
     * @return static
     */
    public static function withPath($path, array $parameters = [])
    {
        $queryString = \GuzzleHttp\Psr7\build_query($parameters);

        return new static(sprintf(
            'Resource not found at path: %s [parameters: %s]',
            $path,
            $queryString
        ));
    }
}
