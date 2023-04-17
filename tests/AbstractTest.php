<?php

declare(strict_types=1);

namespace Tests;

use Core\Router;
use Core\Application;
use Core\Http\Request;
use Core\Http\Response;
use PHPUnit\Framework\TestCase;

abstract class AbstractTest extends TestCase
{
    protected Router $router;

    protected Application $application;

    protected Response $response;

    protected function setUp(): void
    {   
        $router = new Router();
        $this->router = $router;

        $application = new Application($router);
        $this->application = $application;
    }

    /**
     * @param Request $request 
     * @return Response 
     */
    protected function performRequest(Request $request): Response
    {
        ob_start();

        $response = $this->application->handleRequest($request);

        ob_get_contents();
        ob_get_clean();

        return $response;
    }
}