<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Model;

use Adrenth\Thetvdb\Exception\InvalidArgumentException;
use Illuminate\Support\Arr;

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
    /** @var array */
    protected $values;

    /**
     * @param array $values
     */
    public function __construct(array $values)
    {
        $this->values = $values;
    }

    /**
     * @param string $key
     * @return int|null
     */
    protected function intOrNull(string $key): ?int
    {
        $value = Arr::get($this->values, $key);

        if (is_int($value)) {
            return $value;
        }

        return null;
    }

    /**
     * @param string $key
     * @return string|null
     */
    protected function stringOrNull(string $key): ?string
    {
        $value = Arr::get($this->values, $key);

        if (is_string($value)) {
            return $value !== '' ? $value : null;
        }

        return null;
    }

    protected function getCollection(string $key, string $class): array
    {
        $collection = [];

        $items = Arr::get($this->values, $key, []);

        foreach ($items as $item) {
            $collection[] = new $class($item);
        }

        return $collection;
    }

    /**
     * @deprecated Will be dropped in v5.0.0.
     * @param string $name
     * @param array $arguments
     * @return mixed
     * @throws InvalidArgumentException
     */
    final public function __call(string $name, array $arguments = [])
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
     * @deprecated Will be dropped in v5.0.0.
     * @return array
     */
    protected function getAttributes(): array
    {
        return [];
    }
}
