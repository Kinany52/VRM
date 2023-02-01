<?php

declare(strict_types=1);

namespace Tests;

use Core\Application;
use Core\Http\Request;
use Core\Http\Response;
use PHPUnit\Framework\TestCase;

abstract class AbstractTest extends TestCase
{
    protected Response $response;

    protected Application $application;
    
    abstract protected function setUp(): void;

    protected function performRequest(Request $request): Response
    {
        ob_start();

        $response = $this->application->handleRequest($request);

        ob_get_contents();
        ob_get_clean();

        return $response;
    }
}