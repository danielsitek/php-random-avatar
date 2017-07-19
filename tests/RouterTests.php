<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App;

class RouterTests extends TestCase {

    public function testRouterUsesHttps()
    {
        $router = new App\Router();
        $app = $router->useHttps();

        $this->assertInstanceOf(App\Router::class, $app);
    }
}
