<?php

declare(strict_types=1);

namespace App\Repository;

use App\Library\PDO;
use App\Entity\LikesEntity;
use PDOException;

class LikesRepository
{
	/**
	 * @param LikesEntity $LikesEntity 
	 * @return void 
	 * @throws PDOException 
	 */
	public static function persistEntity(LikesEntity $LikesEntity): void
	{
		$insertLike = PDO::instance()->prepare("INSERT INTO likes VALUES(?, ?, ?)");
		$insertLike->execute($LikesEntity->toArray());
	}
	/**
	 * @param string $username 
	 * @param int $post_id 
	 * @return void 
	 * @throws PDOException 
	 */
	public static function dislike(string $username, int $post_id): void
	{
		$deleteLike = PDO::instance()->prepare("DELETE FROM likes WHERE username=? AND post_id=?");
		$deleteLike->execute([$username, $post_id]);
	}
	/**
	 * @param string $username 
	 * @param int $post_id 
	 * @return int 
	 * @throws PDOException 
	 */
	public static function getRowLikes(string $username, int $post_id): int
	{
		$getLikes = PDO::instance()->prepare("SELECT * FROM likes WHERE username=? AND post_id=?");
		$getLikes->execute([$username, $post_id]);
		
		return $getLikes->rowCount();
	}
}