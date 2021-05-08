<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Model;

use Illuminate\Support\Arr;

/**
 * @author Alwin Drenth <adrenth@gmail.com>
 */
final class UpdatedMovies extends ValueObject
{
    /** @var array */
    private $ids;

    public function __construct(array $values)
    {
        parent::__construct($values);

        $this->ids = Arr::get($this->values, 'movies', []);
    }

    public function getIds(): array
    {
        return $this->ids;
    }
}
