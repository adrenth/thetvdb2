<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Model;

/**
 * Class UserRatings.
 *
 * @category Thetvdb
 *
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 *
 * @see     https://github.com/adrenth/thetvdb2
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
