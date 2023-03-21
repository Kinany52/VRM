<?php

declare(strict_types=1);

namespace App\Repository;

use DateTime;
use Generator;
use Throwable;
use PDOException;
use App\Library\PDO;
use ReflectionClass;
use App\Entity\PostsEntity;

class PostsRepository
{
	/**
	 * @param PostsEntity $PostsEntity 
	 * @return int 
	 * @throws PDOException 
	 */
	public static function persistEntity(PostsEntity $PostsEntity): int
	{
		$insertPost = PDO::instance()->prepare(
			<<<SQL
INSERT INTO posts(
body,
added_by,
date_added,
deleted,
likes
)
 VALUES(?, ?, ?, ?, ?)
SQL
		);
		try {	
			$data = $PostsEntity->toArray();
			array_shift($data);
			$insertPost->execute($data);
			return (int)PDO::instance()->lastInsertId();
		} catch (Throwable $th) {
			dump($th);
			throw $th;
		}
	}
	/**
	 * @param mixed $deleted 
	 * @return int 
	 * @throws PDOException 
	 */
	public static function getRowPosts(mixed $deleted): int
	{
		$getPosts = PDO::instance()->prepare("SELECT * FROM posts WHERE deleted=? ORDER BY id DESC");
		$getPosts->execute([$deleted]);

		return $getPosts->rowCount();
	}
	/**
	 * @return Generator 
	 * @throws PDOException 
	 */
	public static function getPosts(): \Generator
	{
		$getPosts = PDO::instance()->prepare("SELECT * FROM posts WHERE deleted=? ORDER BY id DESC");
		$getPosts->execute(['no']);

		/** @var array{'column_name': string, 'column_value': mixed} $postRow */
		$postRow = [];

		while ($postRow = $getPosts->fetch()) {
			$entityReflection = new ReflectionClass(PostsEntity::class);

			$attributesWithTypes = [];

			foreach ($entityReflection->getProperties() as $property) {
				$attributesWithTypes[$property->getName()] = $property->getType()->getName();
			}

			array_walk($postRow, function (string &$column_value, mixed $column_name) use ($attributesWithTypes) {
				if (array_key_exists($column_name, $attributesWithTypes)
					&& $attributesWithTypes[$column_name] === DateTime::class
				) {
					$column_value = DateTime::createFromFormat('Y-m-d H:i:s', $column_value);
				}
				if (array_key_exists($column_name, $attributesWithTypes)
				&& $attributesWithTypes[$column_name] === 'int'
				) {
					$column_value = intval($column_value);
				}
			});
			yield new PostsEntity(...$postRow);
		}
	}
	/**
	 * @param int $id 
	 * @return Generator 
	 * @throws PDOException 
	 */
	public static function getLikes(int $id): \Generator
	{
		$getLikesNum = PDO::instance()->prepare("SELECT * FROM posts WHERE id=?");
		$getLikesNum->execute([$id]);
		
		/** @var array{'column_name' : string, 'column_value' : mixed} $numberLikes */
		$numberLikes = [];

		while ($numberLikes = $getLikesNum->fetch()) {
			$entityReflection = new ReflectionClass(PostsEntity::class);

			$attributesWithTypes = [];

			foreach ($entityReflection->getProperties() as $property) {
				$attributesWithTypes[$property->getName()] = $property->getType()->getName();
			}
			
			array_walk($numberLikes, function(string &$column_value, mixed $column_name) use ($attributesWithTypes) {
				if(array_key_exists($column_name, $attributesWithTypes)
				&& $attributesWithTypes[$column_name] === DateTime::class
				) {
					$column_value = DateTime::createFromFormat('Y-m-d H:i:s', $column_value);
				}
				if(array_key_exists($column_name, $attributesWithTypes)
				&& $attributesWithTypes[$column_name] === 'int'
				) {
					$column_value = intval($column_value);
				}
			});
			yield new PostsEntity(...$numberLikes);
		}	
	}
	/**
	 * @param int $id 
	 * @return Generator 
	 * @throws PDOException 
	 */
	public static function getPoster(int $id): \Generator
	{
		$userQuery = PDO::instance()->prepare("SELECT * FROM posts WHERE id=?");
	 	$userQuery->execute([$id]);

		/** @var array{'column_name' : string, 'column_value' : mixed} $postPoster */
		$postPoster = [];

		while ($postPoster = $userQuery->fetch()) {
			$entityReflection = new ReflectionClass(PostsEntity::class);

			$attributesWithTypes = [];

			foreach ($entityReflection->getProperties() as $property) {
				$attributesWithTypes[$property->getName()] = $property->getType()->getName();
			}
			
			array_walk($postPoster, function(string &$column_value, mixed $column_name) use ($attributesWithTypes) {
				if(array_key_exists($column_name, $attributesWithTypes)
				&& $attributesWithTypes[$column_name] === DateTime::class
				) {
					$column_value = DateTime::createFromFormat('Y-m-d H:i:s', $column_value);
				}
				if(array_key_exists($column_name, $attributesWithTypes)
				&& $attributesWithTypes[$column_name] === 'int'
				) {
					$column_value = intval($column_value);
				}
			});
			yield new PostsEntity(...$postPoster);
		}
	}
	/**
	 * @param int $likes 
	 * @param int $id 
	 * @return void 
	 * @throws PDOException 
	 */
	public static function updateLikes(int $likes, int $id): void
	{
		$query = PDO::instance()->prepare("UPDATE posts SET likes=? WHERE id=?");
		$query->execute([$likes, $id]);
	}
	/**
	 * @param mixed $deleted 
	 * @param int $id 
	 * @return void 
	 * @throws PDOException 
	 */
	public static function deletePost(mixed $deleted, int $id): void
	{
		$query = PDO::instance()->prepare("UPDATE posts SET deleted=? WHERE id=?");
		$query->execute([$deleted, $id]);
	}

	/**
	 * @param int $id 
	 * @return mixed 
	 * @throws PDOException 
	 */
	public static function validatePost(int $id): mixed
	{
		$postExists = PDO::instance()->prepare("SELECT id FROM posts WHERE id=?");
		$postExists->execute([$id]);

		return $postExists->fetch();
	}
}