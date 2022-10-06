<?php

declare(strict_types=1);

namespace App\Repository;

use App\Library\PDO;
use App\Entity\CommentsEntity;
use ReflectionClass;
use DateTime;
use Generator;
use PDOException;

class CommentsRepository
{
	/**
	 * @param CommentsEntity $CommentsEntity 
	 * @return void 
	 * @throws PDOException 
	 */
	public static function persistEntity(CommentsEntity $CommentsEntity): void
	{
		$insertComment = PDO::instance()->prepare("INSERT INTO comments VALUES (?, ?, ?, ?, ?, ?)");
 		$insertComment->execute($CommentsEntity->toArray());
	}
	/**
	 * @param int $post_id 
	 * @return int 
	 * @throws PDOException 
	 */
	public static function getRowComments(int $post_id): int
	{
		$getComments = PDO::instance()->prepare("SELECT * FROM comments WHERE post_id=? ORDER BY id ASC");
		$getComments->execute([$post_id]);

		return $getComments->rowCount();
	}
	/**
	 * @param int $post_id 
	 * @return Generator 
	 * @throws PDOException 
	 */
	public static function getComments(int $post_id): \Generator
	{
		$getComments = PDO::instance()->prepare("SELECT * FROM comments WHERE post_id=? ORDER BY id ASC");
		$getComments->execute([$post_id]);
		
		/** @var array{'column_name' : string, 'column_value' : mixed} $commentRow */
		$commentRow = [];

		while ($commentRow = $getComments->fetch()) {
			$entityReflection = new ReflectionClass(CommentsEntity::class);

			$attributesWithTypes = [];

			foreach ($entityReflection->getProperties() as $property) {
				$attributesWithTypes[$property->getName()] = $property->getType()->getName();
			}

			array_walk($commentRow, function (string &$column_value, mixed $column_name) use ($attributesWithTypes) {
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
			yield new CommentsEntity(...$commentRow);
		}
	}
}