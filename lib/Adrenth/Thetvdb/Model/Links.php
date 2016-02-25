<?php

namespace Adrenth\Thetvdb\Model;

/**
 * Class Links
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb\Model
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb
 *
 * @method int getFirst()
 * @method int getLast()
 * @method int getNext()
 * @method int getPrevious()
 */
class Links extends ValueObject
{
    /**
     * {@inheritdoc}
     */
    public function getAttributes()
    {
        return [
            'first',
            'last',
            'next',
            'previous'
        ];
    }
}
