<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Model;

/**
 * @method int getId()
 * @method int getLastUpdated()
 */
class Update extends ValueObject
{
    public function getAttributes(): array
    {
        return [
            'id',
            'lastUpdated',
        ];
    }
}
