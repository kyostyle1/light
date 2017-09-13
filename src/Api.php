<?php

namespace Cottect;

use Cottect\Api\ApiCollection;
use Cottect\Api\ApiEndpoint;
use Cottect\Api\ApiResource;
use Cottect\Constants\Services;

use Phalcon\Mvc\Micro;
use Phalcon\Mvc\Micro\CollectionInterface;

/**
 * @property \Cottect\QueryParsers\PhqlQueryParser $phqlQueryParser
 * @property \Cottect\Api $application
 * @property \Cottect\Http\Request $request
 * @property \Cottect\Http\Response $response
 * @property \Cottect\Data\Query $query
 * @property \Cottect\Data\Query\UrlQueryParser $urlQueryParser
 * @property \Phalcon\Acl\AdapterInterface $acl
 */
class Api extends Micro
{
    protected $matchedRouteNameParts = null;
    protected $collectionsByIdentifier = [];
    protected $collectionsByName = [];
    protected $endpointsByIdentifier = [];

    /**
     * @return ApiCollection[]
     */
    public function getCollections()
    {
        return array_values($this->collectionsByIdentifier);
    }

    /**
     * @param $name
     *
     * @return ApiCollection|null
     */
    public function getCollection($name)
    {
        return array_key_exists($name, $this->collectionsByName) ? $this->collectionsByName[$name] : null;
    }

    /**
     * @param ApiResource $resource
     *
     * @return static
     * @throws Exception
     */
    public function resource(ApiResource $resource)
    {
        $this->mount($resource);

        return $this;
    }

    public function mount(CollectionInterface $collection)
    {
        if ($collection instanceof ApiCollection) {

            $collectionName = $collection->getName();
            if (!is_null($collectionName)) {
                $this->collectionsByName[$collectionName] = $collection;
            }

            $this->collectionsByIdentifier[$collection->getIdentifier()] = $collection;

            /** @var ApiEndpoint $endpoint */
            foreach ($collection->getEndpoints() as $endpoint) {

                $fullIdentifier = $collection->getIdentifier() . ' ' . $endpoint->getIdentifier();
                $this->endpointsByIdentifier[$fullIdentifier] = $endpoint;
            }
        }
    }

    /**
     * @param ApiCollection $collection
     *
     * @return static
     * @throws Exception
     */
    public function collection(ApiCollection $collection)
    {
        $this->mount($collection);

        return $this;
    }

    /**
     * @return \Cottect\Api\ApiCollection|null  The matched collection
     */
    public function getMatchedCollection()
    {
        $collectionIdentifier = $this->getMatchedRouteNamePart('collection');

        if (!$collectionIdentifier) {
            return null;
        }

        return array_key_exists($collectionIdentifier,
            $this->collectionsByIdentifier) ? $this->collectionsByIdentifier[$collectionIdentifier] : null;
    }

    protected function getMatchedRouteNamePart($key)
    {
        if (is_null($this->matchedRouteNameParts)) {

            $routeName = $this->getRouter()->getMatchedRoute()->getName();

            if (!$routeName) {
                return null;
            }

            $this->matchedRouteNameParts = @unserialize($routeName);
        }

        if (is_array($this->matchedRouteNameParts) && array_key_exists($key, $this->matchedRouteNameParts)) {
            return $this->matchedRouteNameParts[$key];
        }

        return null;
    }

    /**
     * @return \Cottect\Api\ApiEndpoint|null  The matched endpoint
     */
    public function getMatchedEndpoint()
    {
        $collectionIdentifier = $this->getMatchedRouteNamePart('collection');
        $endpointIdentifier = $this->getMatchedRouteNamePart('endpoint');

        if (!$endpointIdentifier) {
            return null;
        }

        $fullIdentifier = $collectionIdentifier . ' ' . $endpointIdentifier;

        return array_key_exists($fullIdentifier,
            $this->endpointsByIdentifier) ? $this->endpointsByIdentifier[$fullIdentifier] : null;
    }

    /**
     * Attaches middleware to the API
     *
     * @param $middleware
     *
     * @return static
     */
    public function attach($middleware)
    {
        if (!$this->getEventsManager()) {
            $this->setEventsManager($this->getDI()->get(Services::EVENTS_MANAGER));
        }

        $this->getEventsManager()->attach('micro', $middleware);

        return $this;
    }
}