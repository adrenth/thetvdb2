<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Extension;

use Adrenth\Thetvdb\ClientExtension;
use Adrenth\Thetvdb\Exception\CouldNotAddFavoriteException;
use Adrenth\Thetvdb\Exception\CouldNotAddOrUpdateUserRatingException;
use Adrenth\Thetvdb\Exception\InvalidArgumentException;
use Adrenth\Thetvdb\Exception\InvalidJsonInResponseException;
use Adrenth\Thetvdb\Exception\RequestFailedException;
use Adrenth\Thetvdb\Exception\UnauthorizedException;
use Adrenth\Thetvdb\Model\UserData;
use Adrenth\Thetvdb\Model\UserFavoritesData;
use Adrenth\Thetvdb\Model\UserRatingsData;
use Adrenth\Thetvdb\Model\UserRatingsDataNoLinks;
use Adrenth\Thetvdb\ResponseHandler;
use GuzzleHttp\Exception\ClientException;
use Psr\Http\Message\ResponseInterface;
use Throwable;

/**
 * For handling user data.
 */
final class UsersExtension extends ClientExtension
{
    private const RATING_TYPE_SERIES = 'series';
    private const RATING_TYPE_EPISODE = 'episode';
    private const RATING_TYPE_BANNER = 'banner';

    private static array $ratingTypes = [
        self::RATING_TYPE_SERIES,
        self::RATING_TYPE_EPISODE,
        self::RATING_TYPE_BANNER,
    ];

    /**
     * Get basic information about the currently authenticated user.
     *
     * @throws RequestFailedException
     * @throws UnauthorizedException
     * @throws InvalidArgumentException
     * @throws InvalidJsonInResponseException
     */
    public function get(): UserData
    {
        $json = $this->client->performApiCallWithJsonResponse('get', '/user');

        /** @var UserData $userData */
        $userData = ResponseHandler::create($json, ResponseHandler::METHOD_USER)->handle();

        return $userData;
    }

    /**
     * Get user favorites.
     *
     * @throws RequestFailedException
     * @throws UnauthorizedException
     * @throws InvalidArgumentException
     * @throws InvalidJsonInResponseException
     */
    public function getFavorites(): UserFavoritesData
    {
        $json = $this->client->performApiCallWithJsonResponse('get', '/user/favorites');

        /** @var UserFavoritesData $userFavoritesData */
        $userFavoritesData = ResponseHandler::create($json, ResponseHandler::METHOD_USER_FAVORITES)->handle();

        return $userFavoritesData;
    }

    /**
     * Remove series with $identifier from favorites.
     *
     * @throws UnauthorizedException
     */
    public function removeFavorite(int $identifier): bool
    {
        $response = $this->client->performApiCall(
            'delete',
            sprintf('user/favorites/%d', (int) $identifier),
            [
                'http_errors' => false,
            ]
        );

        return $response->getStatusCode() === 200 && $response->getReasonPhrase() === 'OK';
    }

    /**
     * Add series with $identifier to favorites.
     *
     * @throws RequestFailedException
     * @throws UnauthorizedException
     * @throws InvalidArgumentException
     * @throws InvalidJsonInResponseException
     * @throws CouldNotAddFavoriteException
     */
    public function addFavorite(int $identifier): UserFavoritesData
    {
        try {
            $json = $this->client->performApiCallWithJsonResponse(
                'put',
                sprintf('user/favorites/%d', $identifier),
                [
                    'http_errors' => true,
                ]
            );
        } catch (ClientException $e) {
            $message = $this->getApiErrorMessage($e->getResponse());

            if ($message !== '') {
                throw CouldNotAddFavoriteException::reason($message);
            }

            throw CouldNotAddFavoriteException::reason($e->getMessage());
        }

        /** @var UserFavoritesData $userFavoritesData */
        $userFavoritesData = ResponseHandler::create($json, ResponseHandler::METHOD_USER_FAVORITES)->handle();

        return $userFavoritesData;
    }

    /**
     * Get user ratings.
     *
     * @param string|null $type Use class constants UsersExtension::RATING_TYPE_*
     *
     * @throws RequestFailedException
     * @throws UnauthorizedException
     * @throws InvalidArgumentException
     * @throws InvalidJsonInResponseException
     */
    public function getRatings(string $type = null): UserRatingsData
    {
        if ($type !== null && !in_array($type, self::$ratingTypes, true)) {
            throw new InvalidArgumentException(
                'Invalid rating type, use one of these instead: '.implode(',', self::$ratingTypes)
            );
        }

        if ($type !== null) {
            $json = $this->client->performApiCallWithJsonResponse(
                'get',
                '/user/ratings/query',
                [
                    'query' => [
                        'itemType' => $type,
                    ],
                ]
            );
        } else {
            $json = $this->client->performApiCallWithJsonResponse('get', '/user/ratings');
        }

        /** @var UserRatingsData $userRatingsData */
        $userRatingsData = ResponseHandler::create($json, ResponseHandler::METHOD_USER_RATINGS)->handle();

        return $userRatingsData;
    }

    /**
     * Add user rating.
     *
     * @param int $type   Use class constants UsersExtension::RATING_TYPE_*
     * @param int $rating Value between 1 and 10
     *
     * @throws RequestFailedException
     * @throws UnauthorizedException
     * @throws InvalidArgumentException
     * @throws InvalidJsonInResponseException
     * @throws CouldNotAddOrUpdateUserRatingException
     */
    public function addRating(int $type, int $itemId, int $rating): UserRatingsDataNoLinks
    {
        if (!in_array($type, self::$ratingTypes, true)) {
            throw new InvalidArgumentException(
                'Invalid rating type, use one of these instead: '.implode(',', self::$ratingTypes)
            );
        }

        try {
            $json = $this->client->performApiCallWithJsonResponse(
                'put',
                sprintf('user/ratings/%s/%d/%d', $type, $itemId, $rating),
                [
                    'http_errors' => true,
                ]
            );
        } catch (ClientException $e) {
            $message = $this->getApiErrorMessage($e->getResponse());

            if ($message !== '') {
                throw CouldNotAddOrUpdateUserRatingException::reason($message);
            }

            throw CouldNotAddOrUpdateUserRatingException::reason($e->getMessage());
        }

        /** @var UserRatingsDataNoLinks $userRatingsDataNoLinks */
        $userRatingsDataNoLinks = ResponseHandler::create($json, ResponseHandler::METHOD_USER_RATINGS_ADD)->handle();

        return $userRatingsDataNoLinks;
    }

    /**
     * Update user rating.
     *
     * @param int $type   Use class constants UsersExtension::RATING_TYPE_*
     * @param int $rating Value between 1 and 10
     *
     * @throws RequestFailedException
     * @throws UnauthorizedException
     * @throws InvalidArgumentException
     * @throws InvalidJsonInResponseException
     * @throws CouldNotAddOrUpdateUserRatingException
     */
    public function updateRating(int $type, int $itemId, int $rating): UserRatingsDataNoLinks
    {
        return $this->addRating($type, $itemId, $rating);
    }

    /**
     * Remove user rating.
     *
     * @throws UnauthorizedException
     */
    public function removeRating(int $type, int $itemId): bool
    {
        $response = $this->client->performApiCall(
            'delete',
            sprintf('user/ratings/%d/%d', (int) $type, (int) $itemId),
            [
                'http_errors' => false,
            ]
        );

        return $response->getStatusCode() === 200 && $response->getReasonPhrase() === 'OK';
    }

    /**
     * Extract error message from response body.
     */
    private function getApiErrorMessage(ResponseInterface $response): string
    {
        try {
            $body = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $throwable) {
            return '';
        }

        if (!is_array($body)) {
            return '';
        }

        return $body['Error'] ?? '';
    }
}
