<?php

declare(strict_types=1);

namespace App\Repository;

use App\Library\PDO;
use App\Entity\UsersEntity;
use Generator;
use PDOException;

class UsersRepository
{
	/**
	 * @param UsersEntity $UsersEntity 
	 * @return void 
	 * @throws PDOException 
	 */
	public static function persistEntity(UsersEntity $UsersEntity): void
	{
		$insertUser = PDO::instance()->prepare("INSERT INTO users VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$insertUser->execute($UsersEntity->toArray());
	}
	/**
	 * @param string $username 
	 * @return array<mixed> 
	 * @throws PDOException 
	 */
	public static function queryUser(string $username): array
	{
		$userQuery = PDO::instance()->prepare("SELECT * FROM users WHERE username=?");
		$userQuery->execute([$username]);

		return $userQuery->fetch();
	}
	/**
	 * @param string|false $email 
	 * @param string $password 
	 * @return Generator 
	 * @throws PDOException 
	 */
	public static function authenticateUser(string|false $email, string $password) :\Generator
	{
		$userQuery = PDO::instance()->prepare("SELECT * FROM users WHERE email=? AND password=?");
		$userQuery->execute([$email, $password]);
		while ($userRow = $userQuery->fetch())
		yield new UsersEntity(...$userRow);
	}
	/**
	 * @param string $username 
	 * @return array<mixed> 
	 * @throws PDOException 
	 */
	public static function authenticateFullname(string $username): array
	{
		$userQuery = PDO::instance()->prepare("SELECT first_name, last_name FROM users WHERE username=?");
		$userQuery->execute([$username]);
		
		return $userQuery->fetch();
	}
	/**
	 * @param string|false $email 
	 * @return array<mixed>
	 * @throws PDOException 
	 */
	public static function inquireStatus(string|false $email): array
	{
		$userClosedQuery = PDO::instance()->prepare("SELECT * FROM users WHERE email=? AND user_closed=?");
		$userClosedQuery->execute([$email, 'yes']);

		return $userClosedQuery->fetch();
	}
	/**
	 * @param string $username 
	 * @return array<mixed>
	 * @throws PDOException 
	 */
	public static function validateUsername(string $username): array
	{
		$usernameExists = PDO::instance()->prepare("SELECT username FROM users WHERE username=?");
		$usernameExists->execute([$username]);

		return $usernameExists->fetch();
	}	
	/**
	 * @param string|false $email 
	 * @return array<mixed>
	 * @throws PDOException 
	 */
	public static function validateEmail(string|false $email): array
	{
		$emailExists = PDO::instance()->prepare("SELECT email FROM users WHERE email=?");
		$emailExists->execute([$email]);

		return $emailExists->fetch();
	}
	/**
	 * @param string $username 
	 * @return Generator 
	 * @throws PDOException 
	 */
	public static function getNumLikes(string $username): \Generator
	{
		$userNumLikes = PDO::instance()->prepare("SELECT * FROM users WHERE username=?");
		$userNumLikes->execute([$username]);
		while ($numLikes = $userNumLikes->fetch())
		yield new UsersEntity(...$numLikes);
	}	
	/**
	 * @param int $num_likes 
	 * @param string $username 
	 * @return void 
	 * @throws PDOException 
	 */
	public static function aggregateLikes(int $num_likes, string $username): void
	{
		$userLikes = PDO::instance()->prepare("UPDATE users SET num_likes=? WHERE username=?");
		$userLikes->execute([$num_likes, $username]);
	}
	/**
	 * @param int $num_post 
	 * @param string $username 
	 * @return void 
	 * @throws PDOException 
	 */
	public static function aggregatePosts(int $num_post, string $username): void
	{
		$userPosts = PDO::instance()->prepare("UPDATE users SET num_posts=? WHERE username=?");
		$userPosts->execute([$num_post, $username]);
	}
	/**
	 * @param string|false $email 
	 * @return void 
	 * @throws PDOException 
	 */
	public static function reactivateUser(string|false $email): void
	{
		$reopenAccount = PDO::instance()->prepare("UPDATE users SET user_closed=? WHERE email=?");
		$reopenAccount->execute(['no', $email]);
	}
}