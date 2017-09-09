<?php
/**
 * Created by PhpStorm.
 * User: BangDinh
 * Date: 7/13/17
 * Time: 09:48
 */

namespace Cottect\Controllers;

use Cottect\Constants\Services;
use Cottect\Export\Documentation;
use Cottect\Transformers\DocumentationTransformer;
use Cottect\Export\Postman\ApiCollection;
use Cottect\Transformers\Postman\ApiCollectionTransformer;
use Cottect\Mvc\Controllers\CollectionController;

class ExportController extends CollectionController
{
    public function documentation()
    {
        /** @var \Phalcon\Config $config */
        $config = $this->di->get(Services::CONFIG);
        $documentation = new Documentation(
            $config->get('application')->title,
            $config->get('hostName')
        );
        $documentation->addManyCollections($this->application->getCollections());
        $documentation->addManyRoutes($this->application->getRouter()->getRoutes());
        return $this->createItemResponse(
            $documentation,
            new DocumentationTransformer(),
            'documentation'
        );
    }

    public function postman()
    {
        /** @var \Phalcon\Config $config */
        $config = $this->di->get(Services::CONFIG);
        $postmanCollection = new ApiCollection(
            $config->get('application')->title,
            $config->get('hostName')
        );
        $postmanCollection->addManyCollections($this->application->getCollections());
        $postmanCollection->addManyRoutes($this->application->getRouter()->getRoutes());
        return $this->createItemResponse($postmanCollection, new ApiCollectionTransformer());
    }
}