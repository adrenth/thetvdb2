<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Model\Movie;

use Adrenth\Thetvdb\Model\ValueObject;

final class Trailer extends ValueObject
{
    private ?string $name;
    private ?string $url;

    public function __construct(array $values)
    {
        parent::__construct($values);

        $this->name = $this->stringOrNull('name');
        $this->url = $this->stringOrNull('url');
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }
}
