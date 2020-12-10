<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb;

/**
 * Interface ClientExtensionInterface.
 *
 * @category Thetvdb
 *
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 *
 * @see     https://github.com/adrenth/thetvdb2
 */
interface ClientExtensionInterface
{
    public function __construct(ClientInterface $client);
}
