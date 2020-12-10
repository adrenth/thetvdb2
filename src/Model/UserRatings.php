<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Model;

/**
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  MIT
 *
 * @method string getRatingType()
 * @method int    getRatingItemId()
 * @method int    getRating()
 */
class UserRatings extends ValueObject
{
    /**
     * {@inheritDoc}
     */
    public function getAttributes(): array
    {
        return [
            'ratingType',
            'ratingItemId',
            'rating',
        ];
    }
}
