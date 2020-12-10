<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Model;

/**
 * Class Language.
 *
 * @category Thetvdb
 *
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 *
 * @see     https://github.com/adrenth/thetvdb2
 *
 * @method int    getId()
 * @method string getAbbreviation()
 * @method string getName()
 * @method string getEnglishName()
 */
class Language extends ValueObject
{
    /**
     * {@inheritDoc}
     */
    public function __construct(array $values)
    {
        if (array_key_exists('data', $values)) {
            parent::__construct($values['data']);
        } else {
            parent::__construct($values);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getAttributes(): array
    {
        return [
            'id',
            'abbreviation',
            'name',
            'englishName',
        ];
    }
}
