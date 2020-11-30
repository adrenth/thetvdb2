<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Model\Movie;

use Adrenth\Thetvdb\Model\ValueObject;

/**
 * Class ReleaseDate
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb\Model\Movie
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb2
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

    /**
     * @return string|null
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @return string|null
     */
    public function getDate(): ?string
    {
        return $this->date;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }
}
