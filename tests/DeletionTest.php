<?php

declare(strict_types=1);

namespace Tests;

use App\Entity\PostsEntity;
use App\Library\PDO;
use App\Repository\PostsRepository;
use Core\Router;
use Core\Application;
use Core\Http\Request;
use DateTime;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\ExpectationFailedException;
use SebastianBergmann\RecursionContext\InvalidArgumentException;

class DeletionTest extends TestCase
{
    protected Router $router;
    protected Application $application;
    protected PDO $pdo;
    protected $fixture;

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
        //fixture that represents an array of a sample post
        $this->fixture = array(
            'body' => 'A new announcement!',
            'added_by' => 'sarmad_alkinany', 
            'date_added' => new DateTime()
        );

        //connect to the DB
        //ALREADY CONNECTED VIA PostRepository

        //seed the DB with test data from fixture
        $postId = PostsRepository::persistEntity(new PostsEntity(
            body: $this->fixture['body'],
            added_by: $this->fixture['added_by'],
            date_added: $this->fixture['date_added'],
        )
        );

        $request = new Request(['QUERY_STRING' => 'delete_post']);

        $_GET['post_id'] = $postId;

        $_POST['result'] = 'true';

        $_SESSION['username'] = $this->fixture['added_by'];

        ob_start();
    
        $response = $this->application->handleRequest($request);

        ob_get_contents();
        ob_get_clean();

        $this->assertEquals(200, $response->httpStatus);
    } 
}