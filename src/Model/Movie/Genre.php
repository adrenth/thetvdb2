<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Model\Movie;

use Adrenth\Thetvdb\Model\ValueObject;

final class Genre extends ValueObject
{
    private ?int $id;
    private ?string $name;
    private ?string $url;

    public function __construct(array $values)
    {
        parent::__construct($values);

        $this->id = $this->intOrNull('id');
        $this->name = $this->stringOrNull('name');
        $this->url = $this->stringOrNull('url');
    }

    public function getId(): ?int
    {
        return $this->id;
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
