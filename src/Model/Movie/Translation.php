<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Model\Movie;

use Adrenth\Thetvdb\Model\ValueObject;
use Illuminate\Support\Arr;

/**
 * Class Translation.
 *
 * @category Thetvdb
 *
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 *
 * @see     https://github.com/adrenth/thetvdb2
 */
final class Translation extends ValueObject
{
    /** @var bool */
    private $isPrimary;

    /** @var string|null */
    private $languageCode;

    /** @var string|null */
    private $name;

    /** @var string|null */
    private $overview;

    /** @var string|null */
    private $tagLine;

    public function __construct(array $values)
    {
        parent::__construct($values);

        $this->isPrimary = (bool) Arr::get($this->values, 'is_primary', false);
        $this->languageCode = $this->stringOrNull('language_code');
        $this->name = $this->stringOrNull('name');
        $this->overview = $this->stringOrNull('overview');
        $this->tagLine = $this->stringOrNull('tagline');
    }

    public function isPrimary(): bool
    {
        return $this->isPrimary;
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
