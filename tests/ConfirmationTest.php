<?php

declare(strict_types=1);

namespace Tests;

use Core\Router;
use Core\Application;
use PHPUnit\Framework\TestCase;

class ConfirmationTest extends TestCase
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

    public function testConfirmCountAggregation(): void
    {
        
    }
}