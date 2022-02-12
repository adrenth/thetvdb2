<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Model;

use Illuminate\Support\Arr;

final class UpdatedMovies extends ValueObject
{
    private array $ids;

    public function __construct(array $values)
    {
        parent::__construct($values);

        $this->ids = (array) Arr::get($this->values, 'movies', []);
    }

    public function getIds(): array
    {
        return $this->ids;
    }
}
