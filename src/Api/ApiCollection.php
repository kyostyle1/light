<?php

namespace Light\Api;

use Light\Exception;
use Light\Constants\ErrorCodes;
use Light\Constants\HttpMethods;
use Light\Constants\PostedDataMethods;

use Phalcon\Mvc\Micro\Collection;
use Phalcon\Mvc\Micro\CollectionInterface;

class ApiCollection extends Collection implements CollectionInterface
{
    protected $name;
    protected $description;

    protected $postedDataMethod = PostedDataMethods::AUTO;

    protected $endpointsByName = [];


    public function __construct($prefix)
    {
        parent::setPrefix($prefix);

        $this->initialize();
    }

    /**
     * Use this method when you extend this class in order to define the collection
     */
    protected function initialize()
    {
    }

    /**
     * Returns collection with default values
     *
     * @param string $prefix Prefix for the collection (e.g. /auth)
     * @param string $name Name for the collection (e.g. authentication) (optional)
     *
     * @return static
     */
    public static function factory($prefix, $name = null)
    {
        $calledClass = get_called_class();

        /** @var ApiCollection $collection */
        $collection = new $calledClass($prefix);

        if ($name) {
            $collection->name($name);
        }

        return $collection;
    }

    /**
     * @param string $name Name for the collection
     *
     * @return static
     */
    public function name($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $description Description of the collection
     *
     * @return static
     */
    public function description($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string Description of the collection
     */
    public function getDescription()
    {
        return $this->description;
    }


    public function setPrefix($prefix)
    {
        throw new Exception(ErrorCodes::GENERAL_SYSTEM, null, 'Setting prefix after initialization is prohibited.');
    }

    /**
     * @param $handler
     * @param bool $lazy
     * @return $this
     */
    public function handler($handler, $lazy = true)
    {
        $this->setHandler($handler, $lazy);
        return $this;
    }

    /**
     * Mounts endpoint to the collection
     *
     * @param ApiEndpoint $endpoint Endpoint to mount (shortcut for endpoint function)
     *
     * @return static
     */
    public function mount(ApiEndpoint $endpoint)
    {
        $this->endpoint($endpoint);
        return $this;
    }

    /**
     * Mounts endpoint to the collection
     *
     * @param ApiEndpoint $endpoint Endpoint to mount
     *
     * @return static
     */
    public function endpoint(ApiEndpoint $endpoint)
    {
        $this->endpointsByName[$endpoint->getName()] = $endpoint;

        switch ($endpoint->getHttpMethod()) {

            case HttpMethods::GET:

                $this->get($endpoint->getPath(), $endpoint->getHandlerMethod(), $this->createRouteName($endpoint));
                break;

            case HttpMethods::POST:

                $this->post($endpoint->getPath(), $endpoint->getHandlerMethod(), $this->createRouteName($endpoint));
                break;

            case HttpMethods::PUT:

                $this->put($endpoint->getPath(), $endpoint->getHandlerMethod(), $this->createRouteName($endpoint));
                break;

            case HttpMethods::DELETE:

                $this->delete($endpoint->getPath(), $endpoint->getHandlerMethod(), $this->createRouteName($endpoint));
                break;
        }

        return $this;
    }

    /**
     * @param ApiEndpoint $endpoint
     * @return string
     */
    protected function createRouteName(ApiEndpoint $endpoint)
    {
        return serialize([
            'collection' => $this->getIdentifier(),
            'endpoint' => $endpoint->getIdentifier()
        ]);
    }

    /**
     * @return string Unique identifier for this collection (returns the prefix)
     */
    public function getIdentifier()
    {
        return $this->getPrefix();
    }

    /**
     * @return ApiEndpoint[] Array of all mounted endpoints
     */
    public function getEndpoints()
    {
        return array_values($this->endpointsByName);
    }

    /**
     * @param string $name Name for the endpoint to return
     *
     * @return ApiEndpoint|null Endpoint with the given name
     */
    public function getEndpoint($name)
    {
        return array_key_exists($name, $this->endpointsByName) ? $this->endpointsByName[$name] : null;
    }

    /**
     * @return string $method One of the method constants defined in PostedDataMethods
     */
    public function getPostedDataMethod()
    {
        return $this->postedDataMethod;
    }

    /**
     * Sets the posted data method to POST
     *
     * @return static
     */
    public function expectsPostData()
    {
        $this->postedDataMethod(PostedDataMethods::POST);
        return $this;
    }

    /**
     * @param string $method One of the method constants defined in PostedDataMethods
     *
     * @return static
     */
    public function postedDataMethod($method)
    {
        $this->postedDataMethod = $method;
        return $this;
    }

    /**
     * Sets the posted data method to JSON_BODY
     *
     * @return static
     */
    public function expectsJsonData()
    {
        $this->postedDataMethod(PostedDataMethods::JSON_BODY);
        return $this;
    }

    /**
     * @return string|null Name of the collection
     */
    public function getName()
    {
        return $this->name;
    }
}