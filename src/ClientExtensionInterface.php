<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb;

interface ClientExtensionInterface
{
    public function __construct(ClientInterface $client);
}
