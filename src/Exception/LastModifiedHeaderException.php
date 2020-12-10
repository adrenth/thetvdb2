<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Exception;

/**
 * Class LastModifiedHeaderException.
 *
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 *
 * @see     https://github.com/adrenth/thetvdb2
 */
class LastModifiedHeaderException extends \InvalidArgumentException
{
    /**
     * @return static
     */
    public static function notFound(): LastModifiedHeaderException
    {
        return new static('Last-Modified header not found');
    }

    /**
     * @return static
     */
    public static function invalidFormat(string $format): LastModifiedHeaderException
    {
        return new static(sprintf(
            'Last-Modified header contains invalid format: %s',
            $format
        ));
    }
}
