<?php

use Core\Router;
use PHPUnit\Framework\TestCase;
use Core\Application;

require __DIR__ . '/../vendor/autoload.php';

class AuthenticationTest extends TestCase
{
    protected Router $router;
    protected Application $application;

    protected function setUp(): void
    {
        $router = new Router();
        $this->router = $router;

        $application = new Application($router);
        $this->application = $application;
    }

    public function testAuthenticationNeeded() : void 
    {
        $response = $this->application->handleRequest($_SERVER['REDIRECT_STATUS']);

        $this->assertEquals(200, $response);
    }
}
