<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb;

abstract class ClientExtension implements ClientExtensionInterface
{
    protected ClientInterface $client;

    final public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }
}
