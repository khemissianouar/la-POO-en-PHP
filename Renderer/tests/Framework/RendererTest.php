<?php
/**
 * Created by PhpStorm.
 * User: lanewris
 * Date: 02/02/18
 * Time: 22:36
 */

namespace Tests\Framework;

use PHPUnit\Framework\TestCase;
use Framework\Renderer;

class RendererTest extends TestCase

{
    private $renderer;

    public function setUp()
    {
        $this->renderer = new Renderer();
        $this->renderer->addPath(__DIR__ . '/views');

    }

    public function testRenderTheRightPath()
    {
        $this->renderer->addPath('blog', __DIR__ . '/views');
        $content = $this->renderer->render('@blog/demo');
        $this->assertEquals('salut', $content);


    }

    public function testRenderTheRightDefaultPath()
    {
        $content = $this->renderer->render('demo');
        $this->assertEquals('salut', $content);


    }

    public function testRenderWithParams()
    {
        $content = $this->renderer->render('demoparams',['nom' =>'Anouar']);
        $this->assertEquals('Salut Anouar', $content);

    }
    public function testGlobalParams()
    {
        $this->renderer->addGlobal('non','Anouar');
        $content = $this->renderer->render('demoparams',['nom' =>'Anouar']);
        $this->assertEquals('Salut Anouar', $content);

    }
}