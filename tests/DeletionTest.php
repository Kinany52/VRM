<?php

declare(strict_types=1);

namespace Tests;

use DateTime;
use Core\Http\Request;
use App\Entity\PostsEntity;
use App\Repository\PostsRepository;
use App\Repository\UsersRepository;
use PHPUnit\Framework\ExpectationFailedException;
use SebastianBergmann\RecursionContext\InvalidArgumentException;

class DeletionTest extends AbstractTest
{
    /**
     * @runInSeparateProcess
     * @return void
     * @throws InvalidArgumentException
     * @throws ExpectationFailedException
     */  
    public function testAuthenticatedUserCandeletePost(): void
    {
        //Using fixture to represent an array of a sample post
        $fixture = array(
            'body' => 'Let\'s do some testing!!',
            'added_by' => 'Donald_Duck', 
            'date_added' => new DateTime()
        );

        //Seed the DB with test data from fixture
        $postId = PostsRepository::persistEntity(new PostsEntity(
            body: $fixture['body'],
            added_by: $fixture['added_by'],
            date_added: $fixture['date_added'],
        )); 

        //Increment post count for user after seeding DB: this step is necessary 
        //because the DeletePostController that is tested here decrements the 
        //number of posts by the user after deleting the post
        $user = UsersRepository::queryUser($fixture['added_by']);
        $num_posts = $user['num_posts'];
        $num_posts++;
        UsersRepository::aggregatePosts($num_posts, $fixture['added_by']);

        $request = new Request(['QUERY_STRING' => 'delete_post']);

        $_GET['post_id'] = $postId;

        $_POST['result'] = 'true';

        $_SESSION['username'] = $fixture['added_by'];

        $response = $this->performRequest($request);

        $this->assertEquals(200, $response->httpStatus);
    } 
}