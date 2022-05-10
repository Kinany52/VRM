<?php

declare(strict_types=1);

namespace App\Repository;

use App\Library\PDO;
use App\Entity\PostsEntity;

class PostsRepository
{
	//Post.php.35.d
	public static function setPostByAll(int $id, string $body, string $added_by, mixed $date_added, mixed $deleted, int $likes)
	{
		$insertPost = PDO::instance()->prepare("INSERT INTO posts VALUES(?, ?, ?, ?, ?, ?)");
		$insertPost->execute([$id, $body, $added_by, $date_added, $deleted, $likes]);
	}
	//Post.php.59.d
	public static function getPostByNotDeleted()
	{
		$getPosts = PDO::instance()->prepare("SELECT * FROM posts WHERE deleted=? ORDER BY id DESC");
		$getPosts->execute(['no']);
		while ($postRow = $getPosts->fetch())
			yield new PostsEntity(...$postRow);
	}

	public static function getRowPostByNotDeleted(mixed $deleted)
	{
		$getPosts = PDO::instance()->prepare("SELECT * FROM posts WHERE deleted=? ORDER BY id DESC");
		$getPosts->execute([$deleted]);

		return $getPosts->rowCount();
	}

	//comment_frame.php.55
	public static function getPosterByPostId(int $post_id): PostsEntity
	{
		$userQuery = PDO::instance()->prepare("SELECT added_by FROM posts WHERE id=?");
	 	$userQuery->execute([$post_id]);

	 	//$row = $userQuery->fetch();
	 	return new PostsEntity(...$userQuery->fetch());
	}
	//like.php.26
	public static function getPosterAndNumberOfLikesByPostId(int $post_id): PostsEntity
	{
		$getLikes = PDO::instance()->prepare("SELECT likes, added_by FROM posts WHERE id=?");
		$getLikes->execute([$post_id]);
		
		//$row = $get_likes->fetch();
		return new PostsEntity(...$getLikes->fetch());
	}
	//like.php.40.53
	public static function updateLikesByPostId(int $postId): PostsEntity
	{
		$query = PDO::instance()->prepare("UPDATE posts SET likes=? WHERE id=?");
		$query->execute([$likes, $post_id]);
	}
	//delete_post.php.14
	public static function deletePostByPostId(int $post_id): PostsEntity
	{
		$query = PDO::instance()->prepare("UPDATE posts SET deleted=? WHERE id=?");
		$query->execute(['yes', $post_id]);
	}
}