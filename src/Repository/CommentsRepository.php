<?php

declare(strict_types=1);

namespace App\Repository;

use App\Library\PDO;
use App\Entity\CommentsEntity;

class CommentsRepository
{
	public static function setCommentByAll(int $id, string $post_body, string $posted_by, string $posted_to, DateTimeImmutable $date_added, int $post_id): CommentsEntity
	{
		$insertComment = PDO::instance(int $post_id)->prepare("INSERT INTO comments VALUES (?, ?, ?, ?, ?, ?)");
 		$insertComment->execute([NULL, $post_body, $userLoggedIn, $posted_to, $date_time_now, $post_id]);
	}

	public static function getCommentByPostId(): CommentsEntity
	{
		$getComments = PDO::instance()->prepare("SELECT * FROM comments WHERE post_id=? ORDER BY id ASC");
		$getComments->execute([$post_id]);

		return new CommentsEntity(...$getComments->fetch());
	}

}