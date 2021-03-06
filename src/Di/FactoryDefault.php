<?php

namespace Cottect\Light\Di;

use Cottect\Light\Exception;
use Cottect\Light\Data\Query;
use Cottect\Light\Http\Request;
use Cottect\Light\Http\Response;
use Cottect\Light\Constants\Services;
use Cottect\Light\Helpers\ErrorHelper;
use Cottect\Light\Constants\ErrorCodes;
use Cottect\Light\Helpers\FormatHelper;
use Cottect\Light\Data\Query\UrlQueryParser;
use Cottect\Light\QueryParsers\PhqlQueryParser;

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