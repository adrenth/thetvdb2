<?php

namespace Adrenth\Tests;

use Adrenth\Thetvdb\Client;
use Adrenth\Thetvdb\Extension\AuthenticationExtension;
use Adrenth\Thetvdb\Extension\EpisodesExtension;
use Adrenth\Thetvdb\Extension\LanguagesExtension;
use Adrenth\Thetvdb\Extension\SearchExtension;
use Adrenth\Thetvdb\Extension\UpdatesExtension;
use Adrenth\Thetvdb\Extension\UsersExtension;
use Adrenth\Thetvdb\Model\Language;
use Adrenth\Thetvdb\Model\LanguageData;
use Illuminate\Support\Collection;

/**
 * Class ClientTest
 *
 * @package Adrenth\Tests
 */
class ClientTest extends \PHPUnit_Framework_TestCase
{
    /** @type Client */
    protected $client;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        // Set up an authenticated client
        $this->client = new Client();
        $this->client->setVersion('1.2.0')
            ->setLanguage('en');

        $token = $this->client->authentication()->login(API_KEY, API_USERNAME, API_PASSWORD);

        self::assertInternalType('string', $token);

        $this->client->setToken($token);
    }

    public function testExtensions()
    {
        self::assertInstanceOf(AuthenticationExtension::class, $this->client->authentication());
        self::assertInstanceOf(EpisodesExtension::class, $this->client->episodes());
        self::assertInstanceOf(LanguagesExtension::class, $this->client->languages());
        self::assertInstanceOf(SearchExtension::class, $this->client->search());
        self::assertInstanceOf(UpdatesExtension::class, $this->client->updates());
        self::assertInstanceOf(UsersExtension::class, $this->client->users());
    }
}
