<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Model\Movie;

use Adrenth\Thetvdb\Model\ValueObject;
use Illuminate\Support\Arr;

/**
 * Class Translation
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb\Model\Movie
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb2
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

    /**
     * @return bool
     */
    public function isPrimary(): bool
    {
        return $this->isPrimary;
    }

    /**
     * @return string|null
     */
    public function getLanguageCode(): ?string
    {
        return $this->languageCode;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getOverview(): ?string
    {
        return $this->overview;
    }

    /**
     * @return string|null
     */
    public function getTagLine(): ?string
    {
        return $this->tagLine;
    }
}
