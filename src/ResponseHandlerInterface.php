<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb;

use Adrenth\Thetvdb\Model\ValueObject;

/**
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  MIT
 */
interface ResponseHandlerInterface
{
    /**
     * Handle the response which produces the Response value object.
     */
    public function handle(): ValueObject;
}
