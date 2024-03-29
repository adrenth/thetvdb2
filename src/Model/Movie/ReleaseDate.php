<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Model\Movie;

use Adrenth\Thetvdb\Model\ValueObject;

final class ReleaseDate extends ValueObject
{
    private ?string $country;
    private ?string $date;
    private ?string $type;

    public function __construct(array $values)
    {
        parent::__construct($values);

        $this->country = $this->stringOrNull('country');
        $this->date = $this->stringOrNull('date');
        $this->type = $this->stringOrNull('type');
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function getType(): ?string
    {
        return $this->type;
    }
}
