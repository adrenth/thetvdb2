<?php

namespace Adrenth\Thetvdb\Model;

/**
 * Class Language
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb\Model
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb
 *
 * @method int getId()
 * @method string getAbbreviation()
 * @method string getName()
 * @method string getEnglishName()
 */
class Language extends ValueObject
{
    /**
     * {@inheritdoc}
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
     * {@inheritdoc}
     */
    public function getAttributes()
    {
        return [
            'id',
            'abbreviation',
            'name',
            'englishName',
        ];
    }
}
