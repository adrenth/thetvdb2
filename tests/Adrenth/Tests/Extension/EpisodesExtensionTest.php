<?php

namespace Adrenth\Tests\Extension;

use Adrenth\Tests\ClientTest;
use Adrenth\Thetvdb\Extension\EpisodesExtension;
use Adrenth\Thetvdb\Model\Episode;

/**
 * Class EpisodesExtensionTest
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb2
 */
class EpisodesExtensionTest extends ClientTest
{
    /** @type EpisodesExtension */
    protected $extension;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();
        $this->extension = new EpisodesExtension($this->client);
    }

    public function testEpisodes()
    {
        // First episode of Series 'Lost'
        $episode = $this->extension->get(127131);

        self::assertInstanceOf(Episode::class, $episode);
    }
}
