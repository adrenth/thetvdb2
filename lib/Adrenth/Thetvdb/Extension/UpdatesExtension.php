<?php

namespace Adrenth\Thetvdb\Extension;

use Adrenth\Thetvdb\ClientExtension;
use Adrenth\Thetvdb\Exception\InvalidArgumentException;
use Adrenth\Thetvdb\Exception\InvalidJsonInResponseException;
use Adrenth\Thetvdb\Exception\RequestFailedException;
use Adrenth\Thetvdb\Exception\UnauthorizedException;
use Adrenth\Thetvdb\Model\UpdateData;
use Adrenth\Thetvdb\ResponseHandler;

/**
 * Class UpdatesExtension
 *
 * Series that have been recently updated
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb\Extension
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb2
 */
class UpdatesExtension extends ClientExtension
{
    /**
     * @param \DateTime $fromTime
     * @param \DateTime $toTime
     * @return UpdateData
     * @throws RequestFailedException
     * @throws UnauthorizedException
     * @throws InvalidArgumentException
     * @throws InvalidJsonInResponseException
     */
    public function query(\DateTime $fromTime, \DateTime $toTime = null)
    {
        if ($toTime === null) {
            $toTime = new \DateTime();
        }
        $options = [
            'query' => [
                'fromTime' => $fromTime->getTimestamp(),
            ],
        ];

        if ($toTime !== null) {
            $options['query']['toTime'] = $toTime->getTimestamp();
        }

        $json = $this->client->performApiCallWithJsonResponse('get', '/updated/query', $options);
        return ResponseHandler::create($json, ResponseHandler::METHOD_UPDATES)->handle();
    }
}
