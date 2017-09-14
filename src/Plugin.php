<?php

namespace Cottect\Light;

use \Phalcon\Di\Injectable;

/**
 *
 * Cottect\Light\Mvc\Plugin
 * This class allows to access services in the services container by just only accessing a public property
 * with the same name of a registered service
 *
 * @property \Cottect\Light\Api $application
 * @property \Cottect\Light\Http\Request $request
 * @property \Cottect\Light\Http\Response $response
 * @property \Phalcon\Acl\AdapterInterface $acl
 * @property \Cottect\Light\Helpers\ErrorHelper $errorHelper
 * @property \Cottect\Light\Helpers\FormatHelper $formatHelper
 * @property \Cottect\Light\Data\Query $query
 * @property \Cottect\Light\Data\Query\UrlQueryParser $urlQueryParser
 */
class Plugin extends Injectable
{

}