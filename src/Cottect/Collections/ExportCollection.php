<?php

namespace Cottect\Collections;

use Cottect\Controllers\ExportController;
use Cottect\Api\ApiCollection;
use Cottect\Api\ApiEndpoint;

class ExportCollection extends ApiCollection
{
    protected function initialize()
    {
        $this
            ->name('Export')
            ->handler(ExportController::class)
            ->endpoint(ApiEndpoint::get('/documentation.json', 'documentation'))
            ->endpoint(ApiEndpoint::get('/postman.json', 'postman'));
    }
}