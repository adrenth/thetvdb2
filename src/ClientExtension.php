<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb;

/**
 * Class ClientExtension.
 *
 * @category Thetvdb
 *
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
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
