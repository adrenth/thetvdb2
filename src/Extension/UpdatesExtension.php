<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Extension;

use Adrenth\Thetvdb\ClientExtension;
use Adrenth\Thetvdb\Exception\InvalidArgumentException;
use Adrenth\Thetvdb\Exception\InvalidJsonInResponseException;
use Adrenth\Thetvdb\Exception\RequestFailedException;
use Adrenth\Thetvdb\Exception\UnauthorizedException;
use Adrenth\Thetvdb\Model\UpdateData;
use Adrenth\Thetvdb\ResponseHandler;
use DateTime;

/**
 * Series that have been recently updated.
 */
final class UpdatesExtension extends ClientExtension
{
    /**
     * @throws RequestFailedException
     * @throws UnauthorizedException
     * @throws InvalidArgumentException
     * @throws InvalidJsonInResponseException
     */
    public function query(DateTime $fromTime, DateTime $toTime = null): UpdateData
    {
        $options = [
            'query' => [
                'fromTime' => $fromTime->getTimestamp(),
            ],
        ];

        if ($toTime !== null) {
            $options['query']['toTime'] = $toTime->getTimestamp();
        }

        $json = $this->client->performApiCallWithJsonResponse('get', '/updated/query', $options);

        /** @var UpdateData $updateData */
        $updateData = ResponseHandler::create($json, ResponseHandler::METHOD_UPDATES)->handle();

        return $updateData;
    }
}
