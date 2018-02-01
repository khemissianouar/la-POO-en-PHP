<?php

namespace Tests\Modules;

use Framework\Router;

class ErroredModule
{

    public function __construct(Router $router)
    {
        $router->get('/demo', function () {
            return new \stdClass();
        }, 'demo');
    }
}