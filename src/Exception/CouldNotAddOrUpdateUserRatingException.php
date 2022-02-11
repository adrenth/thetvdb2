<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Exception;

/**
 * @author   A. Drenth <adrenth@gmail.com>
 * @license  MIT
 */
class CouldNotAddOrUpdateUserRatingException extends \InvalidArgumentException
{
    /**
     * @return static
     */
    public static function reason(string $message): CouldNotAddOrUpdateUserRatingException
    {
        return new static('Could not add rating: '.$message);
    }
}
