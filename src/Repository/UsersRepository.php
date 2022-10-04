<?php

declare(strict_types=1);

namespace App\Repository;

use App\Library\PDO;
use App\Entity\UsersEntity;

class UsersRepository
{
	public static function persistEntity(UsersEntity $UsersEntity): void
	{
		$insertUser = PDO::instance()->prepare("INSERT INTO users VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$insertUser->execute($UsersEntity->toArray());
	}
	public static function queryUser(string $username): mixed
	{
		$userQuery = PDO::instance()->prepare("SELECT * FROM users WHERE username=?");
		$userQuery->execute([$username]);

		return $userQuery->fetch();
	}
	public static function authenticateUser(string $email, string $password) :\Generator
	{
		$userQuery = PDO::instance()->prepare("SELECT * FROM users WHERE email=? AND password=?");
		$userQuery->execute([$email, $password]);
		while ($userRow = $userQuery->fetch())
		yield new UsersEntity(...$userRow);
	}
	public static function authenticateFullname(string $username): mixed
	{
		$userQuery = PDO::instance()->prepare("SELECT first_name, last_name FROM users WHERE username=?");
		$userQuery->execute([$username]);
		
		return $userQuery->fetch();
	}
	public static function inquireStatus(string $email): mixed|false
	{
		$userClosedQuery = PDO::instance()->prepare("SELECT * FROM users WHERE email=? AND user_closed=?");
		$userClosedQuery->execute([$email, 'yes']);

		return $userClosedQuery->fetch();
	}
	public static function validateUsername(string $username): void
	{
		PDO::run("SELECT username FROM users WHERE username=?", [$username])->fetch();
	}	
	public static function validateEmail(string $email): void
	{
		PDO::run("SELECT email FROM users WHERE email=?", [$email])->fetch();
	}
	public static function getNumLikes(string $username): \Generator
	{
		$userNumLikes = PDO::instance()->prepare("SELECT * FROM users WHERE username=?");
		$userNumLikes->execute([$username]);
		while ($numLikes = $userNumLikes->fetch())
		yield new UsersEntity(...$numLikes);
	}	
	public static function aggregateLikes(int $num_likes, string $username): void
	{
		$userLikes = PDO::instance()->prepare("UPDATE users SET num_likes=? WHERE username=?");
		$userLikes->execute([$num_likes, $username]);
	}
	public static function aggregatePosts(int $num_post, string $username):void
	{
		$userPosts = PDO::instance()->prepare("UPDATE users SET num_posts=? WHERE username=?");
		$userPosts->execute([$num_post, $username]);
	}
	public static function reactivateUser(string $email): void
	{
		$reopenAccount = PDO::instance()->prepare("UPDATE users SET user_closed=? WHERE email=?");
		$reopenAccount->execute(['no', $email]);
	}
}