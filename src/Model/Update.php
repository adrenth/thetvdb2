<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Model;

/**
 * Class UpdateData.
 *
 * @category Thetvdb
 *
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 *
 * @see     https://github.com/adrenth/thetvdb2
 *
 * @method int getId()
 * @method int getLastUpdated()
 */
class Update extends ValueObject
{
    /**
     * {@inheritDoc}
     */
    public function getAttributes(): array
    {
        return [
            'id',
            'lastUpdated',
        ];
    }
}
