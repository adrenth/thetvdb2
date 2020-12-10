<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Model\Movie;

use Adrenth\Thetvdb\Model\ValueObject;
use Illuminate\Support\Arr;

/**
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  MIT
 */
final class Artwork extends ValueObject
{
    /** @var string|null */
    private $id;

    /** @var string|null */
    private $type;

    /** @var int|null */
    private $width;

    /** @var int|null */
    private $height;

    /** @var string|null */
    private $url;

    /** @var string|null */
    private $thumbUrl;

    /** @var string|null */
    private $tags;

    /** @var bool */
    private $isPrimary;

    public function __construct(array $values)
    {
        parent::__construct($values);

        $this->id = $this->stringOrNull('id');
        $this->type = $this->stringOrNull('artwork_type');
        $this->width = $this->intOrNull('width');
        $this->height = $this->intOrNull('height');
        $this->url = $this->stringOrNull('url');
        $this->thumbUrl = $this->stringOrNull('thumb_url');
        $this->tags = $this->stringOrNull('tags');
        $this->isPrimary = (bool) Arr::get($this->values, 'is_primary', false);
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getWidth(): ?int
    {
        return $this->width;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function getThumbUrl(): ?string
    {
        return $this->thumbUrl;
    }

    public function getTags(): ?string
    {
        return $this->tags;
    }

    public function isPrimary(): bool
    {
        return $this->isPrimary;
    }
}
