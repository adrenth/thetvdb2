<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb;

/** * Interface ClientExtensionInterface.
 *
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  MIT
 */
interface ClientExtensionInterface
{
    public function __construct(ClientInterface $client);
}
