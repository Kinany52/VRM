<?php

declare(strict_types=1);

namespace App\Entity;

class LikesEntity extends AbstractEntity
{
    public function __construct(
        public readonly int $id,
        public readonly string $username,
        public readonly int $post_id,
    )
    {}

    public function __get($id): ?int
    {
        return $this->$id;
    }

    public function __get($username): string
    {
        return $this->$username;
    }

    public function __get($post_id): ?int 
    {
        return $this->$post_id;
    }
}