<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Extension;

use Adrenth\Thetvdb\ClientExtension;
use Adrenth\Thetvdb\Exception\InvalidArgumentException;
use Adrenth\Thetvdb\Exception\InvalidJsonInResponseException;
use Adrenth\Thetvdb\Exception\RequestFailedException;
use Adrenth\Thetvdb\Exception\UnauthorizedException;
use Adrenth\Thetvdb\Model\Language;
use Adrenth\Thetvdb\Model\LanguageData;
use Adrenth\Thetvdb\ResponseHandler;

/**
 * Available languages and information
 *
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  MIT
 *
 * @see     https://github.com/adrenth/thetvdb2
 */
class LanguagesExtension extends ClientExtension
{
    /**     * Get all available languages.
     *
     * @throws RequestFailedException
     * @throws UnauthorizedException
     * @throws InvalidJsonInResponseException
     * @throws InvalidArgumentException
     */
    public function all(): LanguageData
    {
        $json = $this->client->performApiCallWithJsonResponse('get', '/languages');

        /** @var LanguageData $languageData */
        $languageData = ResponseHandler::create($json, ResponseHandler::METHOD_LANGUAGES)->handle();

        return $languageData;
    }

    /**     * Get information about a particular language, given the language ID.
     *
     * @throws RequestFailedException
     * @throws UnauthorizedException
     * @throws InvalidJsonInResponseException
     * @throws InvalidArgumentException
     */
    public function get(int $identifier): Language
    {
        $json = $this->client->performApiCallWithJsonResponse('get', sprintf('/languages/%d', $identifier));

        /** @var Language $language */
        $language = ResponseHandler::create($json, ResponseHandler::METHOD_LANGUAGE)->handle();

        return $language;
    }
}
