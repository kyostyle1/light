<?php

namespace Cottect\Mvc\Controllers;

class CollectionController extends FractalController
{
    /** @var \Cottect\Api\ApiCollection */
    protected $_collection;

    /** @var \Cottect\Api\ApiEndpoint */
    protected $_endpoint;

    /**
     * @return \Cottect\Api\ApiCollection
     */
    public function getCollection()
    {
        if (!$this->_collection) {
            $this->_collection = $this->application->getMatchedCollection();
        }

        return $this->_collection;
    }

    /**
     * @return \Cottect\Api\ApiEndpoint
     */
    public function getEndpoint()
    {
        if (!$this->_endpoint) {
            $this->_endpoint = $this->application->getMatchedEndpoint();
        }

        return $this->_endpoint;
    }
}