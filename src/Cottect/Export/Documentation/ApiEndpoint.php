<?php

namespace Cottect\Export\Documentation;

class ApiEndpoint
{
    protected $name;
    protected $description;
    protected $httpMethod;
    protected $path;
    protected $exampleResponse;
    protected $allowedRoles = [];
    protected $exampleParameters;
    protected $exampleHeaders;

    /**
     * @return mixed
     */
    public function getExampleParameters()
    {
        return $this->exampleParameters;
    }

    /**
     * @param mixed $exampleParameters
     */
    public function setExampleParameters($exampleParameters)
    {
        $this->exampleParameters = $exampleParameters;
    }

    /**
     * @return mixed
     */
    public function getExampleHeaders()
    {
        return $this->exampleHeaders;
    }

    /**
     * @param mixed $exampleHeaders
     */
    public function setExampleHeaders($exampleHeaders)
    {
        $this->exampleHeaders = $exampleHeaders;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getHttpMethod()
    {
        return $this->httpMethod;
    }

    public function setHttpMethod($httpMethod)
    {
        $this->httpMethod = $httpMethod;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function setPath($path)
    {
        $this->path = $path;
    }

    public function getExampleResponse()
    {
        return $this->exampleResponse;
    }

    public function setExampleResponse($exampleResponse)
    {
        $this->exampleResponse = $exampleResponse;
    }

    public function getAllowedRoles()
    {
        return $this->allowedRoles;
    }

    public function setAllowedRoles($allowedRoles)
    {
        $this->allowedRoles = $allowedRoles;
    }
}