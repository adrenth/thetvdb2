<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Model;

/**
 * @method int    getId()
 * @method string getAbbreviation()
 * @method string getName()
 * @method string getEnglishName()
 */
class Language extends ValueObject
{
    public function __construct(array $values)
    {
        if (array_key_exists('data', $values)) {
            parent::__construct($values['data']);
        } else {
            parent::__construct($values);
        }
    }

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
