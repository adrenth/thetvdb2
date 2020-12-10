<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Model;

/**
 * @author Alwin Drenth <adrenth@gmail.com>
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
