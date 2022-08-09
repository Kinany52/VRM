<?php

declare(strict_types=1);

namespace App\Repository;

use App\Library\PDO;
use App\Entity\CommentsEntity;

class CommentsRepository
{
	public static function persistEntity(CommentsEntity $CommentsEntity)
	{
		$insertComment = PDO::instance()->prepare("INSERT INTO comments VALUES (?, ?, ?, ?, ?, ?)");
 		$insertComment->execute($CommentsEntity->toArray());
	}
	public static function getRowComments(int $post_id)
	{
		$getComments = PDO::instance()->prepare("SELECT * FROM comments WHERE post_id=? ORDER BY id ASC");
		$getComments->execute([$post_id]);

		return $getComments->rowCount();
	}
	public static function getComments(int $post_id)
	{
		$getComments = PDO::instance()->prepare("SELECT * FROM comments WHERE post_id=? ORDER BY id ASC");
		$getComments->execute([$post_id]);
		while ($commentsRow = $getComments->fetch())
		yield new CommentsEntity(...$commentsRow);
	}
}