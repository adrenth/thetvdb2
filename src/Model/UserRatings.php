<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Model;

/**
 * @method string getRatingType()
 * @method int    getRatingItemId()
 * @method int    getRating()
 */
class UserRatings extends ValueObject
{
    public function getAttributes(): array
    {
        return [
            'ratingType',
            'ratingItemId',
            'rating',
        ];
    }
}
