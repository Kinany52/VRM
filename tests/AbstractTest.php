<?php

declare(strict_types=1);

namespace Tests;

use Core\Application;
use PHPUnit\Framework\TestCase;

abstract class AbstractTest extends TestCase
{
    protected Application $application;
    
    abstract protected function setUp(): void;

    public function reuse(): void
    {
        ob_start();

        //$response = $this->application->handleRequest($request);

        ob_get_contents();
        ob_get_clean();
    }
}