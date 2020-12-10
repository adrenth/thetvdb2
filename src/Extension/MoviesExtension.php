<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Extension;

use Adrenth\Thetvdb\ClientExtension;
use Adrenth\Thetvdb\Exception\InvalidArgumentException;
use Adrenth\Thetvdb\Exception\InvalidJsonInResponseException;
use Adrenth\Thetvdb\Exception\RequestFailedException;
use Adrenth\Thetvdb\Exception\UnauthorizedException;
use Adrenth\Thetvdb\Model\Movie;
use Adrenth\Thetvdb\Model\UpdatedMovies;
use Adrenth\Thetvdb\ResponseHandler;
use DateTimeImmutable;

/**
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  MIT
 */
final class MoviesExtension extends ClientExtension
{
    /**
     * @throws InvalidArgumentException
     * @throws InvalidJsonInResponseException
     * @throws RequestFailedException
     * @throws UnauthorizedException
     */
    public function get(int $movieId): Movie
    {
        $json = $this->client->performApiCallWithJsonResponse('get', '/movies/'.$movieId);

        /** @var Movie $movie */
        $movie = ResponseHandler::create($json, ResponseHandler::METHOD_MOVIE)->handle();

        return $movie;
    }

    /**
     * @throws InvalidArgumentException
     * @throws InvalidJsonInResponseException
     * @throws RequestFailedException
     * @throws UnauthorizedException
     */
    public function getUpdates(DateTimeImmutable $dateTime): UpdatedMovies
    {
        $json = $this->client->performApiCallWithJsonResponse(
            'get',
            sprintf('/movieupdates?since=%s', $dateTime->format('Y-m-d'))
        );

        /** @var UpdatedMovies $updatedMovies */
        $updatedMovies = ResponseHandler::create($json, ResponseHandler::METHOD_UPDATED_MOVIES)->handle();

        return $updatedMovies;
    }
}
