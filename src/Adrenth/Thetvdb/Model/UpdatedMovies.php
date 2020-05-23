<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Model;

use Illuminate\Support\Arr;

/**
 * Class UpdatedMovies
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb\Model
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb2
 */
final class UpdatedMovies extends ValueObject
{
    /** @var array */
    private $ids;

    public function __construct(array $values)
    {
        parent::__construct($values);

        $this->ids = Arr::get($this->values, 'movies', []);
    }

    public function getIds(): array
    {
        return $this->ids;
    }
}
