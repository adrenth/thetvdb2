<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Exception;

/**
 * Class LastModifiedHeaderException
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb\Exception
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb2
 */
class LastModifiedHeaderException extends \InvalidArgumentException
{
    /**
     * @return static
     */
    public static function notFound()
    {
        return new static('Last-Modified header not found');
    }

    /**
     * @param string $format
     * @return static
     */
    public static function invalidFormat(string $format)
    {
        return new static(sprintf(
            'Last-Modified header contains invalid format: %s',
            $format
        ));
    }
}
