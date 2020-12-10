<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Model;

/**
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  MIT
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
