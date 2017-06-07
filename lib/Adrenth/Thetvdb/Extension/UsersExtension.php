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

/**
 * Class UsersExtension
 *
 * For handling user data
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb\Extension
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb2
 */
class UsersExtension extends ClientExtension
{
    const RATING_TYPE_SERIES = 'series';
    const RATING_TYPE_EPISODE = 'episode';
    const RATING_TYPE_BANNER = 'banner';

    /** @type array */
    private static $ratingTypes = [
        self::RATING_TYPE_SERIES,
        self::RATING_TYPE_EPISODE,
        self::RATING_TYPE_BANNER
    ];

    /**
     * Get basic information about the currently authenticated user.
     *
     * @return UserData
     * @throws RequestFailedException
     * @throws UnauthorizedException
     * @throws InvalidArgumentException
     * @throws InvalidJsonInResponseException
     */
    public function get(): UserData
    {
        $json = $this->client->performApiCallWithJsonResponse('get', '/user');
        return ResponseHandler::create($json, ResponseHandler::METHOD_USER)->handle();
    }

    /**
     * Get user favorites.
     *
     * @return UserFavoritesData
     * @throws RequestFailedException
     * @throws UnauthorizedException
     * @throws InvalidArgumentException
     * @throws InvalidJsonInResponseException
     */
    public function getFavorites(): UserFavoritesData
    {
        $json = $this->client->performApiCallWithJsonResponse('get', '/user/favorites');
        return ResponseHandler::create($json, ResponseHandler::METHOD_USER_FAVORITES)->handle();
    }

    /**
     * Remove series with $identifier from favorites.
     *
     * @param int $identifier
     * @return bool
     * @throws UnauthorizedException
     */
    public function removeFavorite(int $identifier): bool
    {
        $response = $this->client->performApiCall(
            'delete',
            sprintf('user/favorites/%d', (int) $identifier),
            [
                'http_errors' => false
            ]
        );

        return $response->getStatusCode() === 200 && $response->getReasonPhrase() === 'OK';
    }

    /**
     * Add series with $identifier to favorites.
     *
     * @param int $identifier
     * @return UserFavoritesData
     * @throws RequestFailedException
     * @throws UnauthorizedException
     * @throws InvalidArgumentException
     * @throws InvalidJsonInResponseException
     * @throws CouldNotAddFavoriteException
     */
    public function addFavorite(int $identifier): UserFavoritesData
    {
        $identifier = (int) $identifier;

        try {
            $json = $this->client->performApiCallWithJsonResponse(
                'put',
                sprintf('user/favorites/%d', $identifier),
                [
                    'http_errors' => true
                ]
            );
        } catch (ClientException $e) {
            $message = $this->getApiErrorMessage($e->getResponse());

            if ($message !== '') {
                throw CouldNotAddFavoriteException::reason($message);
            }

            throw CouldNotAddFavoriteException::reason($e->getMessage());
        }

        return ResponseHandler::create($json, ResponseHandler::METHOD_USER_FAVORITES)->handle();
    }

    /**
     * Get user ratings.
     *
     * @param string|null $type Use class constants UsersExtension::RATING_TYPE_*
     * @return UserRatingsData
     * @throws RequestFailedException
     * @throws UnauthorizedException
     * @throws InvalidArgumentException
     * @throws InvalidJsonInResponseException
     */
    public function getRatings(string $type = null): UserRatingsData
    {
        if ($type !== null && !in_array($type, self::$ratingTypes, true)) {
            throw new InvalidArgumentException(
                'Invalid rating type, use one of these instead: ' . implode(self::$ratingTypes, ', ')
            );
        }

        if ($type !== null) {
            $json = $this->client->performApiCallWithJsonResponse(
                'get',
                '/user/ratings/query',
                [
                    'query' => [
                        'itemType' => $type
                    ]
                ]
            );
        } else {
            $json = $this->client->performApiCallWithJsonResponse('get', '/user/ratings');
        }

        return ResponseHandler::create($json, ResponseHandler::METHOD_USER_RATINGS)->handle();
    }

    /**
     * Add user rating.
     *
     * @param int $type Use class constants UsersExtension::RATING_TYPE_*
     * @param int $itemId
     * @param int $rating Value between 1 and 10
     * @return UserRatingsDataNoLinks
     * @throws RequestFailedException
     * @throws UnauthorizedException
     * @throws InvalidArgumentException
     * @throws InvalidJsonInResponseException
     */
    public function addRating(int $type, int $itemId, int $rating): UserRatingsDataNoLinks
    {
        if (!in_array($type, self::$ratingTypes, true)) {
            throw new InvalidArgumentException(
                'Invalid rating type, use one of these instead: ' . implode(self::$ratingTypes, ', ')
            );
        }

        try {
            $json = $this->client->performApiCallWithJsonResponse(
                'put',
                sprintf(
                    'user/ratings/%s/%d/%d',
                    $type,
                    (int) $itemId,
                    (int) $rating
                ),
                [
                    'http_errors' => true
                ]
            );
        } catch (ClientException $e) {
            $message = $this->getApiErrorMessage($e->getResponse());

            if ($message !== '') {
                throw CouldNotAddOrUpdateUserRatingException::reason($message);
            }

            throw CouldNotAddOrUpdateUserRatingException::reason($e->getMessage());
        }

        return ResponseHandler::create($json, ResponseHandler::METHOD_USER_RATINGS_ADD)->handle();
    }

    /**
     * Update user rating.
     *
     * @param int $type Use class constants UsersExtension::RATING_TYPE_*
     * @param int $itemId
     * @param int $rating Value between 1 and 10
     * @return UserRatingsDataNoLinks
     * @throws RequestFailedException
     * @throws UnauthorizedException
     * @throws InvalidArgumentException
     * @throws InvalidJsonInResponseException
     */
    public function updateRating(int $type, int $itemId, int $rating): UserRatingsDataNoLinks
    {
        return $this->addRating($type, $itemId, $rating);
    }

    /**
     * Remove user rating.
     *
     * @param int $type
     * @param int $itemId
     * @return bool
     * @throws UnauthorizedException
     */
    public function removeRating(int $type, int $itemId): bool
    {
        $response = $this->client->performApiCall(
            'delete',
            sprintf('user/ratings/%d/%d', (int) $type, (int) $itemId),
            [
                'http_errors' => false
            ]
        );

        return $response->getStatusCode() === 200 && $response->getReasonPhrase() === 'OK';
    }

    /**
     * Extract error message from response body.
     *
     * @param ResponseInterface $response
     * @return string
     */
    private function getApiErrorMessage(ResponseInterface $response): string
    {
        try {
            $body = $response->getBody()->getContents();
        } catch (\RuntimeException $re) {
            return '';
        }

        if (strpos($body, '"Error"') !== false
            && ($body = json_decode($body, true))
            && array_key_exists('Error', $body)
        ) {
            return $body['Error'];
        }

        return '';
    }
}
