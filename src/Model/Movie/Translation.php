<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Model\Movie;

use Adrenth\Thetvdb\Model\ValueObject;
use Illuminate\Support\Arr;

final class Translation extends ValueObject
{
    private bool $primary;
    private ?string $languageCode;
    private ?string $name;
    private ?string $overview;
    private ?string $tagLine;

    public function __construct(array $values)
    {
        parent::__construct($values);

        $this->primary = (bool) Arr::get($this->values, 'is_primary', false);
        $this->languageCode = $this->stringOrNull('language_code');
        $this->name = $this->stringOrNull('name');
        $this->overview = $this->stringOrNull('overview');
        $this->tagLine = $this->stringOrNull('tagline');
    }

    public function primary(): bool
    {
        return $this->primary;
    }

    public function getLanguageCode(): ?string
    {
        return $this->languageCode;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getOverview(): ?string
    {
        return $this->overview;
    }

    public function getTagLine(): ?string
    {
        return $this->tagLine;
    }
}
