<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Model;

use Adrenth\Thetvdb\Exception\InvalidArgumentException;
use Illuminate\Support\Arr;

abstract class ValueObject
{
    protected array $values;

    public function __construct(array $values)
    {
        $this->values = $values;
    }

    /**
     * @return mixed
     *
     * @throws InvalidArgumentException
     * @deprecated
     */
    final public function __call(string $name, array $arguments = [])
    {
        $attributes = array_flip($this->getAttributes());
        $attribute = strtolower($name[3] ?? '') . substr($name, 4);

        if (!array_key_exists($attribute, $attributes)) {
            throw InvalidArgumentException::undefinedAttribute($attribute, get_class($this));
        }

        if (!array_key_exists($attribute, $this->values)) {
            throw InvalidArgumentException::noValueForAttribute($attribute, get_class($this));
        }

        return $this->values[$attribute];
    }

    protected function intOrNull(string $key): ?int
    {
        $value = Arr::get($this->values, $key);

        if (is_int($value)) {
            return $value;
        }

        return null;
    }

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

        $items = (array) Arr::get($this->values, $key, []);

        foreach ($items as $item) {
            $collection[] = new $class($item);
        }

        return $collection;
    }

    /**
     * @deprecated
     */
    protected function getAttributes(): array
    {
        return [];
    }
}
