<?php

namespace Adrenth\Thetvdb\Model;

use Adrenth\Thetvdb\Exception\InvalidArgumentException;

/**
 * Class ValueObject
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb\Models
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb2
 */
abstract class ValueObject
{
    /** @type array */
    private $values;

    /**
     * @param array $values
     */
    public function __construct(array $values = [])
    {
        $this->values = $values;
    }

    /**
     * @param string $name
     * @param array $arguments
     * @throws \InvalidArgumentException
     */
    final public function __call($name, array $arguments = [])
    {
        $attributes = array_flip($this->getAttributes());
        $attribute = strtolower(substr($name, 3, 1)) . substr($name, 4);

        if (!array_key_exists($attribute, $attributes)) {
            throw InvalidArgumentException::undefinedAttribute($attribute, get_class($this));
        }

        if (!array_key_exists($attribute, $this->values)) {
            throw InvalidArgumentException::noValueForAttribute($attribute, get_class($this));
        }

        return $this->values[$attribute];
    }

    /**
     * @return array
     */
    abstract protected function getAttributes();
}
