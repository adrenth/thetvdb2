<?php

namespace Adrenth\Thetvdb;

/**
 * Class ClientExtension
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb
 */
abstract class ClientExtension implements ClientExtensionInterface
{
    /**
     * @type ClientInterface
     */
    protected $client;

    /**
     * {@inheritdoc}
     */
    final public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }
}
