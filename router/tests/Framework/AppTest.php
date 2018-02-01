<?php
# AppTest.php

namespace Tests\Framework;

use App\Blog\BlogModule;
use GuzzleHttp\Psr7\ServerRequest;
use Framework\App;
use PHPUnit\Framework\TestCase;
use Tests\Modules\StringModule;
use Tests\Modules\ErroredModule;
use GuzzleHttp\Psr7\ResponseInterface;

class AppTest extends TestCase
{

    public function testRedirectTrailingSlash()
    {
        $app = new App();
        $request = new ServerRequest('GET', '/demoslash/');
        $response = $app->run($request);
        $this->assertContains('/demoslash', $response->getHeader('location'));
        $this->assertEquals(301, $response->getStatusCode());


    }

    public function testThrowExeptionIfNoResponseSent()
    {
        $app = new App([
            ErroredModule::class
        ]);
        $request = new ServerRequest('GET', '/demo');
        $this->expectException(\Exception::class);
        $app->run($request);
    }

    public function testConvetStringToResponseSent()
    {
        $app = new App([StringModule::class]);
        $request = new ServerRequest('GET', '/demo');
        $response = $app->run($request);
        
        $this->assertContains('DEMO', (string)$response->getBody());

    }

    public function testError404()
    {
        $app = new App();
        $request = new ServerRequest('GET', '/aze');
        $response = $app->run($request);
        $this->assertContains('<h1>Erreur 404</h1>', (string)$response->getBody());
        $this->assertEquals(404, $response->getStatusCode());

    }

    public function testBlog()
    {
        $app = new App([
            BlogModule::class
        ]);
        $request = new ServerRequest('GET', '/blog');
        $response = $app->run($request);
        $this->assertContains('<h1>Bienvenue sur le blog</h1>', (string)$response->getBody());
        $this->assertEquals(200, $response->getStatusCode());
        $requestSingle = new ServerRequest('GET', '/blog/article-de-test');
        $responseSingle = $app->run($requestSingle);
        $this->assertEquals('<h1>Bienvenue sur l\'articlearticle-de-test</h1>', (string)$responseSingle->getBody());
    }
}