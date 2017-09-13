<?php

namespace Cottect;

/**
 *
 * Cottect\Mvc\Plugin
 * This class allows to access services in the services container by just only accessing a public property
 * with the same name of a registered service
 *
 * @property \Cottect\Api $application
 * @property \Cottect\Http\Request $request
 * @property \Cottect\Http\Response $response
 * @property \Phalcon\Acl\AdapterInterface $acl
 * @property \Cottect\Helpers\ErrorHelper $errorHelper
 * @property \Cottect\Helpers\FormatHelper $formatHelper
 * @property \Cottect\Data\Query $query
 * @property \Cottect\Data\Query\UrlQueryParser $urlQueryParser
 */
use \Phalcon\Di\Injectable;

class Plugin extends Injectable
{

}