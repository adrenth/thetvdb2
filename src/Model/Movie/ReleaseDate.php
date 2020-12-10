<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Model\Movie;

use Adrenth\Thetvdb\Model\ValueObject;

/**
 * Class ReleaseDate.
 *
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 *
 * @see     https://github.com/adrenth/thetvdb2
 */
final class ReleaseDate extends ValueObject
{
    /** @var string|null */
    private $country;

    /** @var string|null */
    private $date;

    /** @var string|null */
    private $type;

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
