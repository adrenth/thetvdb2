<?php

namespace Adrenth\Thetvdb\Exception;

/**
 * Class CouldNotAddOrUpdateUserRatingException
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb\Exception
 * @author   A. Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb
 */
class CouldNotAddOrUpdateUserRatingException extends \InvalidArgumentException
{
    /**
     * @param string $message
     * @return static
     */
    public static function reason($message)
    {
        return new static('Could not add rating: ' . $message);
    }
}
