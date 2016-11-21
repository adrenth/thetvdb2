<?php

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
     * or
     * $token = $client->authentication()->login('apikey');
     * $client->setToken($token);
     *
     * @param string $apiKey
     * @param string $username (optional)
     * @param string $accountIdentifier (optional)
     * @return string
     * @throws CouldNotLoginException
     * @throws UnauthorizedException
     */
    public function login($apiKey, $username = '', $accountIdentifier = '')
    {
        $this->client->setToken(null);

        $arguments = ['apikey' => $apiKey];
        if($username !== '' && $accountIdentifier !== '') {
            $arguments['username'] = $username;
            $arguments['userkey'] = $accountIdentifier;
        }

        $response = $this->client->performApiCall('post', '/login', [
            'body' => json_encode($arguments),
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
        } elseif ($response->getStatusCode() === 401) {
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
    public function refreshToken()
    {
        $data = $this->client->performApiCallWithJsonResponse('get', '/refresh_token');
        $data = (array) json_decode($data);

        if (array_key_exists('token', $data)) {
            return $data['token'];
        }

        throw new TokenNotFoundInResponseException();
    }
}
