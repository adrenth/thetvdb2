<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Extension;

use Adrenth\Thetvdb\ClientExtension;
use Adrenth\Thetvdb\Exception\CouldNotLoginException;
use Adrenth\Thetvdb\Exception\RequestFailedException;
use Adrenth\Thetvdb\Exception\TokenNotFoundInResponseException;
use Adrenth\Thetvdb\Exception\UnauthorizedException;

/**
 * Class AuthenticationExtension
 *
 * Obtaining and refreshing your JWT token
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb\Extension
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb2
 */
class AuthenticationExtension extends ClientExtension
{
    /**
     * Returns a session token to be included in the rest of the requests.
     *
     * Example of usage:
     * $token = $client->authentication()->login('apikey', 'username', 'accountIdentifier');
     * $client->setToken($token);
     *
     * @param string $apiKey
     * @param string $username
     * @param string $accountIdentifier
     * @return string
     * @throws CouldNotLoginException
     * @throws UnauthorizedException
     */
    public function login(string $apiKey, string $username = null, string $accountIdentifier = null): string
    {
        $this->client->setToken(null);

        $data = [
            'apikey' => $apiKey
        ];

        if ($username !== null) {
            $data['username'] = $username;
        }

        if ($accountIdentifier !== null) {
            $data['userkey'] = $accountIdentifier;
        }

        $response = $this->client->performApiCall('post', '/login', [
            'body' => json_encode($data),
            'http_errors' => true
        ]);

        if ($response->getStatusCode() === 200) {
            try {
                $contents = $response->getBody()->getContents();
            } catch (\RuntimeException $e) {
                throw CouldNotLoginException::invalidContents($e->getMessage());
            }

            $contents = (array) json_decode($contents);

            if (!array_key_exists('token', $contents)) {
                throw CouldNotLoginException::noTokenInResponse();
            }

            return $contents['token'];
        }

        if ($response->getStatusCode() === 401) {
            throw CouldNotLoginException::unauthorized();
        }

        throw CouldNotLoginException::failedWithStatusCode($response->getStatusCode());
    }

    /**
     * Refreshes your current, valid JWT token and returns a new token.
     *
     * @return string
     * @throws TokenNotFoundInResponseException
     * @throws RequestFailedException
     * @throws UnauthorizedException
     */
    public function refreshToken(): string
    {
        $data = $this->client->performApiCallWithJsonResponse('get', '/refresh_token');
        $data = (array) json_decode($data);

        if (array_key_exists('token', $data)) {
            return $data['token'];
        }

        throw new TokenNotFoundInResponseException('No token found in response.');
    }
}
