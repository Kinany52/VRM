<?php

declare(strict_types=1);

namespace App\Repository;

use App\Library\PDO;
use App\Entity\LikesEntity;

class LikesRepository
{
	public static function persistEntity(LikesEntity $LikesEntity)
	{
		$insertLike = PDO::instance()->prepare("INSERT INTO likes VALUES(?, ?, ?)");
		$insertLike->execute($LikesEntity->toArray());
	}
	public static function dislike(string $username, int $post_id)
	{
		$deleteLike = PDO::instance()->prepare("DELETE FROM likes WHERE username=? AND post_id=?");
		$deleteLike->execute([$username, $post_id]);
	}
	public static function getRowLikes(string $username, int $post_id)
	{
		$getLikes = PDO::instance()->prepare("SELECT * FROM likes WHERE username=? AND post_id=?");
		$getLikes->execute([$username, $post_id]);
		
		return $getLikes->rowCount();
	}
}