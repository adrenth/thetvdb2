<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb;

use Adrenth\Thetvdb\Model\ValueObject;

interface ResponseHandlerInterface
{
    /**
     * Handle the response which produces the Response value object.
     */
    public function handle(): ValueObject;
}
