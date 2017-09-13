<?php

namespace Light\Di;

use Light\Exception;
use Light\Data\Query;
use Light\Http\Request;
use Light\Http\Response;
use Light\Constants\Services;
use Light\Helpers\ErrorHelper;
use Light\Constants\ErrorCodes;
use Light\Helpers\FormatHelper;
use Light\Data\Query\UrlQueryParser;
use Light\QueryParsers\PhqlQueryParser;

class FactoryDefault extends \Phalcon\Di\FactoryDefault
{
    public function __construct()
    {
        parent::__construct();
        $this->setShared(Services::FRACTAL_MANAGER, function () {
            $className = '\League\Fractal\Manager';
            if (!class_exists($className)) {
                throw new Exception(ErrorCodes::GENERAL_SYSTEM, null,
                    '\League\Fractal\Manager was requested, but class could not be found');
            }
            return new $className();
        });
        $this->setShared(Services::PHQL_QUERY_PARSER, new PhqlQueryParser);
        $this->setShared(Services::REQUEST, new Request);
        $this->setShared(Services::RESPONSE, new Response);
        $this->setShared(Services::QUERY, new Query);
        $this->setShared(Services::URL_QUERY_PARSER, new UrlQueryParser);
        $this->setShared(Services::ERROR_HELPER, new ErrorHelper);
        $this->setShared(Services::FORMAT_HELPER, new FormatHelper);
    }
}