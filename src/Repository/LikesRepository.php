<?php

declare(strict_types=1);

namespace App\Repository;

use App\Library\PDO;
use App\Entity\LikesEntity;

class LikesRepository
{
	//like.php.45
	public static function setLikeByAll(int $id, string $username, int $post_id): LikesEntity
	{
		$insertLike = PDO::instance()->prepare("INSERT INTO likes VALUES(?, ?, ?)");
		$insertLike->execute([NULL, $userLoggedIn, $post_id]);
	}
	//like.php.58
	public static function deleteLikeByUsernameAndPostId(string $username, int $post_id): LikesEntity
	{
		$deleteLike = PDO::instance()->prepare("DELETE FROM likes WHERE username=? AND post_id=?");
		$deleteLike->execute([$userLoggedIn, $post_id]);
	}
	//like.php.63
	public static function getLikeByUsernameAndPostId(string $username, int $post_id): LikesEntity
	{
		$getLikes = PDO::instance()->prepare("SELECT * FROM likes WHERE username=? AND post_id=?");
		$getLikes->execute([$userLoggedIn, $post_id]);
		
		return new LikesEntity(...$getLikes->fetch());
	}
}