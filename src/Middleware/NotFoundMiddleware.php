<?php

namespace Cottect\Light\Middleware;

use Cottect\Light\Plugin;
use Cottect\Light\Exception;
use Cottect\Light\Constants\ErrorCodes;

use Phalcon\Mvc\Micro;
use Phalcon\Mvc\Micro\MiddlewareInterface;

class NotFoundMiddleware extends Plugin implements MiddlewareInterface
{
    public function beforeNotFound()
    {
        throw new Exception(ErrorCodes::GENERAL_NOT_FOUND);
    }

    public function call(Micro $api) {

        return true;
    }
}
