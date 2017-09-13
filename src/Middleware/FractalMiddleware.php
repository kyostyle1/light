<?php

namespace Cottect\Middleware;

use Cottect\Plugin;
use Cottect\Constants\Services;

use Phalcon\Mvc\Micro;
use Phalcon\Mvc\Micro\MiddlewareInterface;

class FractalMiddleware extends Plugin implements MiddlewareInterface
{
    public $parseIncludes;

    public function __construct($parseIncludes = true)
    {
        $this->parseIncludes = $parseIncludes;
    }

    public function beforeExecuteRoute()
    {
        /** @var \League\Fractal\Manager $fractal */
        $fractal = $this->di->get(Services::FRACTAL_MANAGER);

        if ($this->parseIncludes) {

            $include = $this->request->getQuery('include');

            if (!is_null($include)) {
                $fractal->parseIncludes($include);
            }
        }
    }

    public function call(Micro $api)
    {

        return true;
    }
}