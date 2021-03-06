<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Exception;

/**
 * @author Alwin Drenth <adrenth@gmail.com>
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
