<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Model\Movie;

use Adrenth\Thetvdb\Model\ValueObject;

/**
 * Class Trailer.
 *
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 *
 * @see     https://github.com/adrenth/thetvdb2
 */
final class Trailer extends ValueObject
{
    /** @var string|null */
    private $name;

    /** @var string|null */
    private $url;

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
