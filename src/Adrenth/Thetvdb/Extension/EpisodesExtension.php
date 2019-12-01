<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Extension;

use Adrenth\Thetvdb\ClientExtension;
use Adrenth\Thetvdb\Exception\InvalidArgumentException;
use Adrenth\Thetvdb\Exception\InvalidJsonInResponseException;
use Adrenth\Thetvdb\Exception\RequestFailedException;
use Adrenth\Thetvdb\Exception\UnauthorizedException;
use Adrenth\Thetvdb\Model\Episode;
use Adrenth\Thetvdb\ResponseHandler;

/**
 * Class EpisodesExtension
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb\Extension
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb2
 */
class EpisodesExtension extends ClientExtension
{
    /**
     * Returns the full information for a given episode ID.
     *
     * @param int $episodeId
     * @return Episode
     * @throws RequestFailedException
     * @throws UnauthorizedException
     * @throws InvalidJsonInResponseException
     * @throws InvalidArgumentException
     */
    public function get($episodeId): Episode
    {
        $json = $this->client->performApiCallWithJsonResponse('get', '/episodes/' . (int) $episodeId);
        return ResponseHandler::create($json, ResponseHandler::METHOD_EPISODE)->handle();
    }
}
