<?php

declare(strict_types=1);

namespace App\Repository;

use App\Library\PDO;
use App\Entity\CommentsEntity;

class CommentsRepository
{
	//comment_frame.php.64
	public static function setCommentByAll(int $id, string $post_body, string $posted_by, string $posted_to, DateTimeImmutable $date_added, int $post_id): CommentsEntity
	{
		$insertComment = PDO::instance()->prepare("INSERT INTO comments VALUES (?, ?, ?, ?, ?, ?)");
 		$insertComment->execute([$id, $post_body, $posted_by, $posted_to, $date_added, $post_id]);
	}
	//comment_frame.php.78
	public static function getCommentByPostIdOrdered(int $post_id): CommentsEntity
	{
		$getComments = PDO::instance()->prepare("SELECT * FROM comments WHERE post_id=? ORDER BY id ASC");
		$getComments->execute([$post_id]);

		return new CommentsEntity(...$getComments->fetch());
	}
	//Posts.php.114
	public static function getCommentByPostId(int $post_id): CommentsEntity
	{
		$getComments = PDO::instance()->prepare("SELECT * FROM comments WHERE post_id=?");
		$getComments->execute([$id]);

		return new CommentsEntity(...$getComments->fetch());
	}

}