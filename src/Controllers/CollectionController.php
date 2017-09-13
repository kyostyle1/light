<?php

namespace Light\Controllers;

class CollectionController extends FractalController
{
    /** @var \Light\Api\ApiCollection */
    protected $_collection;

    /** @var \Light\Api\ApiEndpoint */
    protected $_endpoint;

    /**
     * @return \Light\Api\ApiCollection
     */
    public function getCollection()
    {
        if (!$this->_collection) {
            $this->_collection = $this->application->getMatchedCollection();
        }
        return $this->_collection;
    }

    /**
     * @return \Light\Api\ApiEndpoint
     */
    public function getEndpoint()
    {
        if (!$this->_endpoint) {
            $this->_endpoint = $this->application->getMatchedEndpoint();
        }
        return $this->_endpoint;
    }
}