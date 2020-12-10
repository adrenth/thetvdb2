<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Model;

/**
 * Class SeriesImagesQueryParam.
 *
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 *
 * @see     https://github.com/adrenth/thetvdb2
 *
 * @method string getKeyType()
 * @method string getLanguageId()
 * @method array  getResolution()
 * @method array  getSubKey()
 */
class SeriesImagesQueryParam extends ValueObject
{
    /**
     * {@inheritDoc}
     */
    public function getAttributes(): array
    {
        return [
            'keyType',
            'languageId',
            'resolution',
            'subKey',
        ];
    }
}
