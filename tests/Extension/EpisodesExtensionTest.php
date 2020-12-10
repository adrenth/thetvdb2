<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Tests\Extension;

use Adrenth\Thetvdb\Extension\EpisodesExtension;
use Adrenth\Thetvdb\Model\Episode;
use Adrenth\Thetvdb\Tests\ClientTest;

/**
 * Class EpisodesExtensionTest.
 *
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 *
 * @see     https://github.com/adrenth/thetvdb2
 */
class EpisodesExtensionTest extends ClientTest
{
    /** @var EpisodesExtension */
    protected $extension;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->extension = new EpisodesExtension($this->client);
    }

    public function testEpisodes(): void
    {
        // First episode of Series 'Lost'
        $episode = $this->extension->get(127131);

        self::assertInstanceOf(Episode::class, $episode);
    }
}
