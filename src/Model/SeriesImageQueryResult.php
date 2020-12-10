<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Model;

/**
 * Class SeriesImageQueryResult.
 *
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  MIT
 *
 * @see     https://github.com/adrenth/thetvdb2
 *
 * @method int    getId()
 * @method string getKeyType()
 * @method string getSubKey()
 * @method string getFileName()
 * @method int    getLanguageId()
 * @method string getResolution()
 * @method int    getRatingsInfo()
 * @method string getThumbnail()
 */
class SeriesImageQueryResult extends ValueObject
{
    /**
     * {@inheritDoc}
     */
    public function getAttributes(): array
    {
        return [
            'id',
            'keyType',
            'subKey',
            'fileName',
            'languageId',
            'resolution',
            'ratingsInfo',
            'thumbnail',
        ];
    }
}
