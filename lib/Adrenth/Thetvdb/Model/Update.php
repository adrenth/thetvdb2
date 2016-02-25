<?php

namespace Adrenth\Thetvdb\Model;

/**
 * Class UpdateData
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb\Model
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb
 *
 * @method int getId()
 * @method int getLastUpdated()
 */
class Update extends ValueObject
{
    /**
     * {@inheritdoc}
     */
    public function getAttributes()
    {
        return [
            'id',
            'lastUpdated',
        ];
    }
}
