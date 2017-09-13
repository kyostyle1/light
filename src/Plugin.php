<?php

namespace Light;

/**
 *
 * Light\Mvc\Plugin
 * This class allows to access services in the services container by just only accessing a public property
 * with the same name of a registered service
 *
 * @property \Light\Api $application
 * @property \Light\Http\Request $request
 * @property \Light\Http\Response $response
 * @property \Phalcon\Acl\AdapterInterface $acl
 * @property \Light\Helpers\ErrorHelper $errorHelper
 * @property \Light\Helpers\FormatHelper $formatHelper
 * @property \Light\Data\Query $query
 * @property \Light\Data\Query\UrlQueryParser $urlQueryParser
 */
use \Phalcon\Di\Injectable;

class Plugin extends Injectable
{

}