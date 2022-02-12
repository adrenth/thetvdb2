<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Model\Movie;

use Adrenth\Thetvdb\Model\ValueObject;

final class RemoteId extends ValueObject
{
    private ?string $id;
    private ?int $sourceId;
    private ?string $sourceName;
    private ?string $sourceUrl;
    private ?string $url;

    public function __construct(array $values)
    {
        parent::__construct($values);

        $this->id = $this->stringOrNull('id');
        $this->sourceId = $this->intOrNull('source_id');
        $this->sourceName = $this->stringOrNull('source_name');
        $this->sourceUrl = $this->stringOrNull('source_url');
        $this->url = $this->stringOrNull('url');
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getSourceId(): ?int
    {
        return $this->sourceId;
    }

    public function getSourceName(): ?string
    {
        return $this->sourceName;
    }

    public function getSourceUrl(): ?string
    {
        return $this->sourceUrl;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }
}
