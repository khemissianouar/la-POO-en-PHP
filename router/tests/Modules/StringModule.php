<?php

namespace Tests\Modules;

use Framework\Router;

class StringModule
{

    public function __construct(Router $route)
    {
        $route->get('/demo', function () {
            return 'DEMO';
        },
            'demo');
    }
}