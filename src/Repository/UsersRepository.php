<?php

declare(strict_types=1);

namespace App\Repository;

use App\Library\PDO;
use App\Entity\UsersEntity;

class UsersRepository
{
	//User.php.14.comment_frame.php.13...
	public static function getUserByUsername(string $username): UsersEntity
	{
		$userQuery = PDO::instance()->prepare("SELECT * FROM users WHERE username=?");
		$userQuery->execute([$username]);

		return new UsersEntity(...$userQuery->fetch());
	}
	//login_handler.php.12
	public static function getUserByEmailAndPassword(string $email, string $password): UsersEntity
	{
		$userQuery = PDO::instance()->prepare("SELECT * FROM users WHERE email=? AND password=?");
		$userQuery->execute([$email, $password]);

		return new UsersEntity(...$userQuery->fetch());
	}
	//login_handler.php.22
	public static function getUserByEmailAndClosedStatus(string $email, bool $user_closed): UsersEntity
	{
		$userClosedQuery = PDO::instance()->prepare("SELECT * FROM users WHERE email=? AND user_closed=?");
		$userClosedQuery->execute([$email, 'yes']);

		return new UsersEntity(...$userClosedQuery->fetch());
	}
	//register_handler.php.57
	public static function emailValidation(string $email): UsersEntity
	{
		$emailCheck = PDO::run("SELECT email FROM users WHERE email=?", [$email])->fetch();
	}
	//register_handler.php.114
	public static function setUserByAll(int $id, string $first_name, string $last_name, string $username, string $email, string $password, DateTimeImmutable $signup_date, int $num_post, int $num_likes, bool $user_closed): UsersEntity
	{
		$insertUser = PDO::run("INSERT INTO users (id, first_name, last_name, username, email, password, signup_date, num_posts, num_likes, user_closed) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", [$id, $first_name, $last_name, $username, $email, $password, $signup_date, $num_post, $num_likes, $user_closed]);
	}
	//like.php.43.56
	public static function updateTotalUserLikesByUsername(string $username): UsersEntity
	{
		$userLikes = PDO::instance()->prepare("UPDATE users SET num_likes=? WHERE username=?");
		$userLikes->execute([$num_likes, $username]);
	}
	//Post.php.42
	public static function updateTotalUserPostsByUsername(string $username): UsersEntity
	{
		$userPosts = PDO::instance()->prepare("UPDATE users SET num_posts=? WHERE username=?");
		$userPosts->execute([$num_post, $username]);
	}
	//login_handler.php.27
	public static function reopenClosedUserAccountByUsername(string $username): UsersEntity
	{
		$reopenAccount = PDO::instance()->prepare("UPDATE users SET user_closed=? WHERE email=?");
		$reopenAccount->execute(['no', $email]);
	}
}