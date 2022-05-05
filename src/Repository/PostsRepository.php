<?php

declare(strict_types=1);

namespace App\Repository;

use App\Library\PDO;
use App\Entity\PostsEntity;

class PostsRepository
{
	//Post.php.35
	public static public function setPostByAll(int $id, string $body, string $added_by, DateTimeImmutable $date_added, bool $deleted, int $likes): PostsRepository
	{
		$insertPost = PDO::instance()->prepare("INSERT INTO posts VALUES(?, ?, ?, ?, ?, ?)");
		$insertPost->execute([$id, $body, $added_by, $date_added, $deleted, $likes]);
	}
	//Post.php.59
	public static function getPostByNotDeleted(bool $deleted): PostsRepository
	{
		$getPosts = PDO::instance()->prepare("SELECT * FROM posts WHERE deleted=? ORDER BY id DESC");
		$getPosts->execute(['no']);

		return new PostsEntity(...$getPosts->fetch());
	}
	//comment_frame.php.55
	public static function getPosterByPostId(int $post_id): PostsRepository
	{
		$userQuery = PDO::instance()->prepare("SELECT added_by FROM posts WHERE id=?");
	 	$userQuery->execute([$post_id]);

	 	//$row = $userQuery->fetch();
	 	return new PostsEntity(...$userQuery->fetch());
	}
	//like.php.26
	public static function getPosterAndNumberOfLikesByPostId(int $post_id): PostsRepository
	{
		$getLikes = PDO::instance()->prepare("SELECT likes, added_by FROM posts WHERE id=?");
		$getLikes->execute([$post_id]);
		
		//$row = $get_likes->fetch();
		return new PostsEntity(...$getLikes->fetch());
	}
	//like.php.40.53
	public static function updateLikesByPostId(int $postId): PostsRepository
	{
		$query = PDO::instance()->prepare("UPDATE posts SET likes=? WHERE id=?");
		$query->execute([$likes, $post_id]);
	}
	//delete_post.php.14
	public static function deletePostByPostId(int $post_id): PostsRepository
	{
		$query = PDO::instance()->prepare("UPDATE posts SET deleted=? WHERE id=?");
		$query->execute(['yes', $post_id]);
	}
}