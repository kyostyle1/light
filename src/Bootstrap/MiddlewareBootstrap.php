<?php

namespace Cottect\Light\Bootstrap;

use Cottect\Light\Api;
use Cottect\Light\BootstrapInterface;
use Cottect\Light\Middleware\UrlQueryMiddleware;
use Cottect\Light\Middleware\FractalMiddleware;
use Cottect\Light\Middleware\CorsMiddleware;
use Cottect\Light\Middleware\NotFoundMiddleware;
use Cottect\Light\Middleware\OptionsResponseMiddleware;

use Phalcon\Config;
use Phalcon\DiInterface;

class MiddlewareBootstrap implements BootstrapInterface
{
    public function run(Api $api, DiInterface $di, Config $config)
    {
        $api
            ->attach(new CorsMiddleware($config->get('cors')->allowedOrigins->toArray()))
            ->attach(new OptionsResponseMiddleware)
            ->attach(new NotFoundMiddleware)
            ->attach(new FractalMiddleware)
            ->attach(new UrlQueryMiddleware);
    }
}