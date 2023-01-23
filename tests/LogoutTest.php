<?php

declare(strict_types=1);

namespace Tests;

use Core\Router;
use Core\Application;
use Core\Http\Request;
use PHPUnit\Framework\TestCase;

class LogoutTest extends TestCase
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

    /**
     * @runInSeparateProcess
     * @return void
     * @throws InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public function testLoggedInUserCanLogout(): void
    {
        $request = new Request(['QUERY_STRING' => '']);

        $response = $this->application->handleRequest($request);

        $this->assertEquals(302, $response->httpStatus);
    }
}