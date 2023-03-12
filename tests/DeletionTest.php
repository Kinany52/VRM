<?php

declare(strict_types=1);

namespace Tests;

use Core\Router;
use Core\Application;
use Core\Http\Request;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\ExpectationFailedException;
use SebastianBergmann\RecursionContext\InvalidArgumentException;

class DeletionTest extends TestCase
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
    public function testAuthenticatedUserCandeletePost(): void
    {
        $request = new Request(['QUERY_STRING' => 'delete_post']);

        $_GET['post_id'] = 257;

        $_POST['result'] = 'true';

        $_SESSION['username'] = 'anastasia_Schreiber';

        ob_start();
    
        $response = $this->application->handleRequest($request);

        ob_get_contents();
        ob_get_clean();

        $this->assertEquals(200, $response->httpStatus);
    }

    // /**
    //  * @runInSeparateProcess
    //  * @return void
    //  * @throws InvalidArgumentException
    //  * @throws ExpectationFailedException
    //  */  
    // public function testAnnouncementCountAggregation(): void
    // {
    //     //post_id=163 is not deleted; post_id=124 is deleted
    //     $request = new Request(['QUERY_STRING' => 'delete_post&post_id=201']);

    //     $_SESSION['username'] = 'wojciech_gula';

    //     ob_start();

    //     $response = $this->application->handleRequest($request);

    //     ob_get_contents();
    //     ob_get_clean();

    //     $this->assertEquals(200, $response->httpStatus);
    // }
    
}