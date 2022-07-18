<?php

declare(strict_types=1);

namespace App\Repository;

use App\Library\PDO;
use App\Entity\UsersEntity;

class UsersRepository
{
	//register_handler.php.114.d
	public static function persistEntity(UsersEntity $UsersEntity)
	{
		$insertUser = PDO::instance()->prepare("INSERT INTO users VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$insertUser->execute($UsersEntity->toArray());
	}
	//User.php.14.comment_frame.php.13...d
	public static function validateSession(string $username)
	{
		$userQuery = PDO::instance()->prepare("SELECT * FROM users WHERE username=?");
		$userQuery->execute([$username]);

		return $userQuery->fetch();
	}
	//login_handler.php.12.d
	public static function authenticateUser(string $email, string $password)
	{
		$userQuery = PDO::instance()->prepare("SELECT * FROM users WHERE email=? AND password=?");
		$userQuery->execute([$email, $password]);
		while ($userRow = $userQuery->fetch())
		yield new UsersEntity(...$userRow);
		
	}
	//login_handler.php.22.d
	public static function inquireStatus(string $email)
	{
		$userClosedQuery = PDO::instance()->prepare("SELECT * FROM users WHERE email=? AND user_closed=?");
		$userClosedQuery->execute([$email, 'yes']);

		return $userClosedQuery->fetch();
	}
	//register_handler.php.57.d
	public static function validateEmail(string $email)
	{
		PDO::run("SELECT email FROM users WHERE email=?", [$email])->fetch();
	}
	//like.php.43.56
	public static function updateTotalUserLikesByUsername(string $username)
	{
		$userLikes = PDO::instance()->prepare("UPDATE users SET num_likes=? WHERE username=?");
		$userLikes->execute([$num_likes, $username]);
	}
	//Post.php.42
	public static function updateTotalUserPostsByUsername(string $username)
	{
		$userPosts = PDO::instance()->prepare("UPDATE users SET num_posts=? WHERE username=?");
		$userPosts->execute([$num_post, $username]);
	}
	//login_handler.php.27
	public static function reopenClosedUserAccountByUsername(string $username)
	{
		$reopenAccount = PDO::instance()->prepare("UPDATE users SET user_closed=? WHERE email=?");
		$reopenAccount->execute(['no', $email]);
	}
}