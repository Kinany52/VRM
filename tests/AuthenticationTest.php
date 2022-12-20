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

    /**
     * @runInSeparateProcess
     * @return void
     * @throws InvalidArgumentException
     * @throws ExpectationFailedException
     */
    public function testAuthentedUserCanSeePost(): void
    {
        $request = new Request(['QUERY_STRING' => '']);

        $_SESSION['username'] = 'javier_varela';
        //assigning existing user to authentication object, which is $_SESION to make application aware that it is dealing with authenticated user

        ob_start();

        $response = $this->application->handleRequest($request);

        ob_get_contents();
        ob_get_clean();

        $this->assertEquals(200, $response->httpStatus);
    }
}
