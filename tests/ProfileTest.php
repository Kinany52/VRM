<?php

declare(strict_types=1);

namespace Tests;

use Core\Router;
use Core\Application;
use Core\Http\Request;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;
use SebastianBergmann\RecursionContext\InvalidArgumentException;

class ProfileTest extends TestCase
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
    public function testViewProfilePageOfSelectedUser(): void
    {
        $request = new Request(['QUERY_STRING' => 'profile']);

        $response = $this->application->handleRequest($request);

        $this->assertEquals(200, $response->httpStatus);
    }
}