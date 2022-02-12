<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Extension;

use Adrenth\Thetvdb\ClientExtension;
use Adrenth\Thetvdb\Exception\CouldNotLoginException;
use Adrenth\Thetvdb\Exception\RequestFailedException;
use Adrenth\Thetvdb\Exception\TokenNotFoundInResponseException;
use Adrenth\Thetvdb\Exception\UnauthorizedException;
use JsonException;
use RuntimeException;
use Throwable;

final class AuthenticationExtension extends ClientExtension
{
    /**
     * Returns a session token to be included in the rest of the requests.
     *
     * Example of usage:
     * $token = $client->authentication()->login('apikey', 'username', 'accountIdentifier');
     * $client->setToken($token);
     *
     * @throws CouldNotLoginException
     * @throws UnauthorizedException
     */
    public function login(string $apiKey, ?string $username = null, ?string $accountIdentifier = null): string
    {
        $this->client->setToken(null);

        $data = [
            'apikey' => $apiKey,
        ];

        if ($username !== null) {
            $data['username'] = $username;
        }

        if ($accountIdentifier !== null) {
            $data['userkey'] = $accountIdentifier;
        }
        try {
            $response = $this->client->performApiCall('post', '/login', [
                'body' => json_encode($data, JSON_THROW_ON_ERROR),
                'http_errors' => true,
            ]);
        } catch (Throwable $throwable) {
            throw CouldNotLoginException::withReason($throwable->getMessage());
        }

        if ($response->getStatusCode() === 200) {
            try {
                $contents = $response->getBody()->getContents();
            } catch (RuntimeException $exception) {
                throw CouldNotLoginException::invalidContents($exception->getMessage());
            }
            try {
                $contents = (array) json_decode($contents, true, 512, JSON_THROW_ON_ERROR);
            } catch (JsonException $exception) {
                $contents = [];
            }

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
     * @throws TokenNotFoundInResponseException
     * @throws RequestFailedException
     * @throws UnauthorizedException
     */
    public function refreshToken(): string
    {
        $data = $this->client->performApiCallWithJsonResponse('get', '/refresh_token');

        try {
            $data = (array) json_decode($data, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $exception) {
            $data = [];
        }

        if (array_key_exists('token', $data)) {
            return $data['token'];
        }

        throw new TokenNotFoundInResponseException('No token found in response.');
    }
}
