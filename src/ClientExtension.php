<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb;

/**
 * Class ClientExtension.
 *
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  MIT
 *
 * @see     https://github.com/adrenth/thetvdb2
 */
abstract class ClientExtension implements ClientExtensionInterface
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * {@inheritDoc}
     */
    final public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }
}
