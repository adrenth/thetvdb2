<?php

namespace Adrenth\Thetvdb;

/**
 * Interface ClientExtensionInterface
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb2
 */
interface ClientExtensionInterface
{
    /**
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client);
}
