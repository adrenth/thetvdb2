<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb;

/**
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  MIT
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
