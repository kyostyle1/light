<?php

namespace Light\Helpers;

use Light\Constants\ErrorCodes;

class ErrorHelper
{
    protected $errors = [

        ErrorCodes::GENERAL_SYSTEM => [
            'statusCode' => 500,
            'message' => 'General: System Error'
        ],

        ErrorCodes::GENERAL_NOT_IMPLEMENTED => [
            'statusCode' => 500,
            'message' => 'General: Not Implemented'
        ],

        ErrorCodes::GENERAL_NOT_FOUND => [
            'statusCode' => 404,
            'message' => 'General: Not Found'
        ],

        ErrorCodes::ACCESS_DENIED => [
            'statusCode' => 403,
            'message' => 'Access: Denied'
        ],

        ErrorCodes::DATA_FAILED => [
            'statusCode' => 500,
            'message' => 'Data: Failed'
        ],

        ErrorCodes::DATA_NOT_FOUND => [
            'statusCode' => 404,
            'message' => 'Data: Not Found'
        ],

        ErrorCodes::POST_DATA_NOT_PROVIDED => [
            'statusCode' => 400,
            'message' => 'Post data: Not provided'
        ],

        ErrorCodes::POST_DATA_INVALID => [
            'statusCode' => 400,
            'message' => 'Post data: Invalid'
        ]
    ];

    /**
     * @param $code
     *
     * @return array|null
     */
    public function get($code)
    {
        return $this->has($code) ? $this->errors[$code] : null;
    }

    /**
     * @param $code
     *
     * @return bool
     */
    public function has($code)
    {
        return array_key_exists($code, $this->errors);
    }

    /**
     * @param $code
     * @param $message
     * @param $statusCode
     *
     * @return static
     */
    public function error($code, $message, $statusCode)
    {
        $this->errors[$code] = [
            'statusCode' => $statusCode,
            'message' => $message
        ];

        return $this;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param array $errors
     */
    public function setErrors(array $errors)
    {
        $this->errors = $errors;
    }
}
