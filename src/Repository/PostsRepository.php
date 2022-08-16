<?php

declare(strict_types=1);

namespace App\Repository;

use App\Library\PDO;
use App\Entity\PostsEntity;
use ReflectionClass;
use ReflectionParameter;
use ReflectionProperty;
use DateTime;

class PostsRepository
{
	public static function persistEntity(PostsEntity $PostsEntity)
	{
		$insertPost = PDO::instance()->prepare("INSERT INTO posts VALUES(?, ?, ?, ?, ?, ?)");
		$insertPost->execute($PostsEntity->toArray());
	}
	public static function getRowPosts(mixed $deleted)
	{
		$getPosts = PDO::instance()->prepare("SELECT * FROM posts WHERE deleted=? ORDER BY id DESC");
		$getPosts->execute([$deleted]);

		return $getPosts->rowCount();
	}
	public static function getPosts()
	{
		$getPosts = PDO::instance()->prepare("SELECT * FROM posts WHERE deleted=? ORDER BY id DESC");
		$getPosts->execute(['no']);

		/** @var array<$column_name : string => $column_value : mixed> $postRow */
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
			//dd($postRow, $attributesWithTypes);
			yield new PostsEntity(...$postRow);
		}
	}
	public static function getLikes(int $id)
	{
		$getLikesNum = PDO::instance()->prepare("SELECT * FROM posts WHERE id=?");
		$getLikesNum->execute([$id]);
		
		/** @var array<$column_name : string => $column_value : mixed> $postRow */
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
	public static function getPoster(int $id)
	{
		$userQuery = PDO::instance()->prepare("SELECT * FROM posts WHERE id=?");
	 	$userQuery->execute([$id]);

		/** @var array<$column_name : string => $column_value : mixed> $postRow */
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
	public static function updateLikes(int $likes, int $id)
	{
		$query = PDO::instance()->prepare("UPDATE posts SET likes=? WHERE id=?");
		$query->execute([$likes, $id]);

	}
	public static function deletePost(mixed $deleted, int $id)
	{
		$query = PDO::instance()->prepare("UPDATE posts SET deleted=? WHERE id=?");
		$query->execute([$deleted, $id]);
	}
}