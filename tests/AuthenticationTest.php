<?php

use Core\Router;
use PHPUnit\Framework\TestCase;
use Core\Application;
use SebastianBergmann\RecursionContext\InvalidArgumentException;
use PHPUnit\Framework\ExpectationFailedException;

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

    /**
     * @runInSeparateProcess
     * @return void 
     * @throws InvalidArgumentException 
     * @throws ExpectationFailedException 
     */
    public function testAuthenticationNeeded() : void 
    {
        $request = ['QUERY_STRING' => ''];

        //ob_start();
        //$this->application->handleRequest($request);
        //$headers = headers_list();
        $response = $this->application->handleRequest($request);

         //ob_clean();
// dd(headers_list());
        // $ob_dumper = function(callable $executeMe): void
        // {

        //     ob_start();

        //     $executeMe();
        //     $output = ob_get_contents();
        //     ob_flush();

        //     dump($output);
        // };

        // $ob_dumper(fn() =>  $this->application->handleRequest($request));

        $this->assertEquals('here we would like to see that we got header location', $response);
    }
}
