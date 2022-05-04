<?php

declare(strict_types=1);

namespace App\Repository;

use App\Library\PDO;
use App\Entity\PostsEntity;

class PostsRepository
{
	public static public function setPostByAll(int $id, string $body, string $added_by, DateTimeImmutable $date_added, bool $deleted, int $likes): PostsRepository
	{
		$insertPost = PDO::instance()->prepare("INSERT INTO posts VALUES(?, ?, ?, ?, ?, ?)");
		$insertPost->execute([NULL, $body, $added_by, $date_added, 'no', '0']);
	}

	public static function getPostByNotDeleted(bool $deleted): PostsRepository
	{
		$getPosts = PDO::instance()->prepare("SELECT * FROM posts WHERE deleted=? ORDER BY id DESC");
		$getPosts->execute(['no']);

		return new PostsEntity(...$getPosts->fetch());
	}
}