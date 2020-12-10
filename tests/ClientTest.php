<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Tests;

use Adrenth\Thetvdb\Client;
use Adrenth\Thetvdb\Extension\AuthenticationExtension;
use Adrenth\Thetvdb\Extension\EpisodesExtension;
use Adrenth\Thetvdb\Extension\LanguagesExtension;
use Adrenth\Thetvdb\Extension\SearchExtension;
use Adrenth\Thetvdb\Extension\UpdatesExtension;
use Adrenth\Thetvdb\Extension\UsersExtension;

/**/
class ClientTest extends \PHPUnit_Framework_TestCase
{
    /** @var Client */
    protected $client;

    /**     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        // Set up an authenticated client
        $this->client = new Client();
        $this->client->setVersion('2.3.0');
        $this->client->setLanguage('en');

        $token = $this->client->authentication()->login(API_KEY, API_USERNAME, API_USER_KEY);

        self::assertInternalType('string', $token);

        $this->client->setToken($token);
    }

    public function testExtensions(): void
    {
        self::assertInstanceOf(AuthenticationExtension::class, $this->client->authentication());
        self::assertInstanceOf(EpisodesExtension::class, $this->client->episodes());
        self::assertInstanceOf(LanguagesExtension::class, $this->client->languages());
        self::assertInstanceOf(SearchExtension::class, $this->client->search());
        self::assertInstanceOf(UpdatesExtension::class, $this->client->updates());
        self::assertInstanceOf(UsersExtension::class, $this->client->users());
    }
}
