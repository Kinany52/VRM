<?php

namespace App\Controller;

use DateTime;
use App\Entity\PostsEntity;
use App\Repository\PostsRepository;
use App\Repository\UsersRepository;
use Core\Http\Response;
use PDOException;

Class SubmitPostController
{   
    /**
     * @param mixed $body 
     * @return Response 
     * @throws PDOException 
     */
    public function submitPost($body): Response
	{
		$body = strip_tags($body); //removes html tags
		$body = str_replace('\r\n', '\n', $body); //Allows new line character
		$body = nl2br($body); //Replace new lines with line breaks

		$check_empty = preg_replace('/\s+/', '', $body); //Deletes all spaces

		if($check_empty != "") {
			//Current date and time
			$date_added = new DateTime();
			//Get username
			$added_by = $_SESSION['username'];
			//Insert post
			PostsRepository::persistEntity(new PostsEntity(
				date_added: $date_added, 
				body: $body, 
				added_by: $added_by,
			));
			//Update post count for user
			$userArray = UsersRepository::queryUser($added_by);
			$num_posts = $userArray['num_posts'];
			$num_posts++;
			UsersRepository::aggregatePosts($num_posts, $added_by);
		}
		return new Response(httpStatus: 200);
	}
}