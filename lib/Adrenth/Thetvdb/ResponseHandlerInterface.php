<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb;

use Adrenth\Thetvdb\Model\ValueObject;

/**
 * Class ResponseHandlerInterface
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb2
 */
interface ResponseHandlerInterface
{
    /**
     * Handle the response which produces the Response value object.
     *
     * @return ValueObject
     */
    public function handle(): ValueObject;
}
