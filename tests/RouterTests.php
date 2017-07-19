<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App;

class RouterTests extends TestCase {

    private $root = __DIR__ . '/images';

    private $images = array(
        'man' => array(
            '/man/001.png'
        ),
        'woman' => array(
            '/woman/001.png'
        )
    );

    public function testRouterUsesHttps()
    {
        $router = new App\Router();
        $app = $router->useHttps();

        $this->assertInstanceOf(App\Router::class, $app);
    }
}
