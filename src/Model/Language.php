<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Model;

/**
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  MIT
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
