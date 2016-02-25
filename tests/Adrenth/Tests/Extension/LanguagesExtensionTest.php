<?php

namespace Adrenth\Tests\Extension;

use Adrenth\Thetvdb\Client;
use Adrenth\Thetvdb\Extension\LanguagesExtension;
use Adrenth\Thetvdb\Model\Language;
use Adrenth\Thetvdb\Model\LanguageData;
use Illuminate\Support\Collection;

/**
 * Class LanguagesExtensionTest
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb2
 */
class LanguagesExtensionTest extends \PHPUnit_Framework_TestCase
{
    /** @type LanguagesExtension */
    protected $extension;

    public function setUp()
    {
        $client = new Client();
        $token = $client->authentication()->login(API_KEY, API_USERNAME, API_PASSWORD);
        $client->setToken($token);
        $this->extension = new LanguagesExtension($client);
    }

    public function testAllLanguages()
    {
        $languages = $this->extension->all();

        self::assertInstanceOf(LanguageData::class, $languages);

        $data = $languages->getData();

        self::assertInstanceOf(Collection::class, $data);

        /** @type Language $language */
        $language = $data->first();

        self::assertInstanceOf(Language::class, $language);

        $language = $this->extension->get($language->getId());

        self::assertInstanceOf(Language::class, $language);

        self::assertInternalType('string', $language->getName());
        self::assertInternalType('string', $language->getAbbreviation());
        self::assertInternalType('string', $language->getEnglishName());
        self::assertInternalType('int', $language->getId());
    }
}

