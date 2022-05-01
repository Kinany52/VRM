<?php

declare(strict_types=1);

namespace App\Entity;

class PostsEntity extends AbstractEntity
{
    public function __construct(
        public readonly int $id,
        public readonly string $body,
        public readonly string $added_by,
        public readonly DateTimeImmutable $date_added,
        public readonly bool $deleted,
        public readonly int $likes,
    )
    {}

    public function __get($id): ?int
    {
        return $this->$id;
    }

    public function __get($body): string
    {
        return $this->$body;
    }

    public function __get($added_by): string
    {
        return $this->$added_by;
    }

    public function __get($date_added): DateTimeImmutable
    {
        return $this->$date_added;
    }

    public function __get($deleted): bool
    {
        return $this->$deleted;
    }

    public function __get($likes): ?int
    {
        return $this->$likes;
    }
}

