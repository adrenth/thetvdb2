<?php

namespace Adrenth\Thetvdb\Model;

/**
 * Class SeriesImagesQueryParam
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb\Model
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb2
 *
 * @method string getKeyType()
 * @method string getLanguageId()
 * @method array getResolution()
 * @method array getSubKey()
 */
class SeriesImagesQueryParam extends ValueObject
{
    /**
     * {@inheritdoc}
     */
    public function getAttributes()
    {
        return [
            'keyType',
            'languageId',
            'resolution',
            'subKey'
        ];
    }
}
