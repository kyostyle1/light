<?php

namespace Cottect\Light\Middleware;

use Cottect\Light\Plugin;

use Phalcon\Mvc\Micro;
use Phalcon\Mvc\Micro\MiddlewareInterface;

class OptionsResponseMiddleware extends Plugin implements MiddlewareInterface
{
    public function beforeHandleRoute()
    {
        if ($this->request->isOptions()) {
            $this->response->setJsonContent([
                'result' => 'OK',
            ]);
            return false;
        }
        return true;
    }

    public function call(Micro $api)
    {
        return true;
    }
}