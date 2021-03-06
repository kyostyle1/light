<?php

namespace Cottect\Light\Controllers;

class CollectionController extends FractalController
{
    /** @var \Cottect\Light\Api\ApiCollection */
    protected $_collection;

    /** @var \Cottect\Light\Api\ApiEndpoint */
    protected $_endpoint;

    /**
     * @return \Cottect\Light\Api\ApiCollection
     */
    public function getCollection()
    {
        if (!$this->_collection) {
            $this->_collection = $this->application->getMatchedCollection();
        }
        return $this->_collection;
    }

    /**
     * @return \Cottect\Light\Api\ApiEndpoint
     */
    public function getEndpoint()
    {
        if (!$this->_endpoint) {
            $this->_endpoint = $this->application->getMatchedEndpoint();
        }
        return $this->_endpoint;
    }
}