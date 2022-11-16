<?php

declare(strict_types=1);

namespace Tests;

use Core\Http\Header;
use Core\Http\Request;
use Core\Router;
use PHPUnit\Framework\TestCase;
use Core\Application;
use SebastianBergmann\RecursionContext\InvalidArgumentException;
use PHPUnit\Framework\ExpectationFailedException;

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

    /**
     * @runInSeparateProcess
     * @return void
     * @throws InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public function testAuthenticationNeeded(): void
    {
        $request = new Request(['QUERY_STRING' => '']);

        $response = $this->application->handleRequest($request);

        $this->assertEquals(
            new Header(
                'Location',
                '/auth'
            ),
            $response->getHeaders()[0]
        );
    }
}
