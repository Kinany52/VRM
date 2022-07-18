<?php

declare(strict_types=1);

namespace App\Repository;

use App\Library\PDO;
use App\Entity\PostsEntity;

class PostsRepository
{
	//Post.php:35.d
	public static function persistEntity(PostsEntity $PostsEntity)
	{
		$insertPost = PDO::instance()->prepare("INSERT INTO posts VALUES(?, ?, ?, ?, ?, ?)");
		$insertPost->execute($PostsEntity->toArray());
	}
	//Post.php:59.d
	public static function getRowPosts(mixed $deleted)
	{
		$getPosts = PDO::instance()->prepare("SELECT * FROM posts WHERE deleted=? ORDER BY id DESC");
		$getPosts->execute([$deleted]);

		return $getPosts->rowCount();
	}
	//Post.php:59.d
	public static function getPosts()
	{
		$getPosts = PDO::instance()->prepare("SELECT * FROM posts WHERE deleted=? ORDER BY id DESC");
		$getPosts->execute(['no']);
		while ($postRow = $getPosts->fetch())
		yield new PostsEntity(...$postRow);
	}
	//like.php.26.d
	public static function getLikes(int $id)
	{
		$getLikesNum = PDO::instance()->prepare("SELECT * FROM posts WHERE id=?");
		$getLikesNum->execute([$id]);
		while ($numberLikes = $getLikesNum->fetch())
		yield new PostsEntity(...$numberLikes);

	}
	//comment_frame.php:55.d
	public static function getPoster(int $id)
	{
		$userQuery = PDO::instance()->prepare("SELECT added_by FROM posts WHERE id=?");
	 	$userQuery->execute([$id]);
		//while ($poster = $userQuery->fetch())
		//yield new PostsEntity(...$poster);
		return $userQuery->rowCount();
	}
	//like.php.40.53.sd
	public static function updateLikes(int $likes, int $id)
	{
		$query = PDO::instance()->prepare("UPDATE posts SET likes=? WHERE id=?");
		$query->execute([$likes, $id]);

		//return $query->rowCount();
	}
	//delete_post.php.14.d
	public static function deletePost(mixed $deleted, int $id)
	{
		$query = PDO::instance()->prepare("UPDATE posts SET deleted=? WHERE id=?");
		$query->execute([$deleted, $id]);
	}
}