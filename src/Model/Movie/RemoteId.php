<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Model\Movie;

use Adrenth\Thetvdb\Model\ValueObject;

/**
 * Class RemoteId
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb\Model\Movie
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb2
 */
final class RemoteId extends ValueObject
{
    /** @var string|null */
    private $id;

    /** @var int|null */
    private $sourceId;

    /** @var string|null */
    private $sourceName;

    /** @var string|null */
    private $sourceUrl;

    /** @var string|null */
    private $url;

    public function __construct(array $values)
    {
        parent::__construct($values);

        $this->id = $this->stringOrNull('id');
        $this->sourceId = $this->intOrNull('source_id');
        $this->sourceName = $this->stringOrNull('source_name');
        $this->sourceUrl = $this->stringOrNull('source_url');
        $this->url = $this->stringOrNull('url');
    }

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @return int|null
     */
    public function getSourceId(): ?int
    {
        return $this->sourceId;
    }

    /**
     * @return string|null
     */
    public function getSourceName(): ?string
    {
        return $this->sourceName;
    }

    /**
     * @return string|null
     */
    public function getSourceUrl(): ?string
    {
        return $this->sourceUrl;
    }

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }
}
