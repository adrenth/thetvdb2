<?php

namespace Adrenth\Thetvdb;

/**
 * Class ResponseHandlerInterface
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb
 */
interface ResponseHandlerInterface
{
    /**
     * Handle the response which produces the Response object
     *
     * @return Response
     */
    public function handle();
}
