<?php

namespace Cottect\Middleware;

use Cottect\Plugin;
use Cottect\Data\Query;
use Cottect\Constants\Services;

use Phalcon\Mvc\Micro;
use Phalcon\Mvc\Micro\MiddlewareInterface;

class UrlQueryMiddleware extends Plugin implements MiddlewareInterface
{
    public function beforeExecuteRoute()
    {
        $params = $this->getDI()->get(Services::REQUEST)->getQuery();
        $query = $this->getDI()->get(Services::URL_QUERY_PARSER)->createQuery($params);
        /** @var Query $queryService */
        $queryService  = $this->getDI()->get(Services::QUERY);
        $queryService->merge($query);
    }

    public function call(Micro $api)
    {
        return true;
    }
}