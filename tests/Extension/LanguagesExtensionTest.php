<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Tests\Extension;

use Adrenth\Thetvdb\Extension\LanguagesExtension;
use Adrenth\Thetvdb\Model\Language;
use Adrenth\Thetvdb\Model\LanguageData;
use Adrenth\Thetvdb\Tests\ClientTest;
use Illuminate\Support\Collection;

/**
 * Class LanguagesExtensionTest.
 *
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  MIT
 *
 * @see     https://github.com/adrenth/thetvdb2
 */
class LanguagesExtensionTest extends ClientTest
{
    /** @var LanguagesExtension */
    protected $extension;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->extension = new LanguagesExtension($this->client);
    }

    public function testAllLanguages(): void
    {
        $languages = $this->extension->all();

        self::assertInstanceOf(LanguageData::class, $languages);

        $data = $languages->getData();

        self::assertInstanceOf(Collection::class, $data);

        /** @var Language $language */
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
