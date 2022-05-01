<?php

declare(strict_types=1);

namespace App\Entity;

class CommentsEntity extends AbstractEntity
{
    public function __construct(
        public readonly int $id,
        public readonly string $post_body,
        public readonly string $posted_by,
        public readonly string $posted_to,
        public readonly DateTimeImmutable $date_added,
        public readonly int $post_id,
    )
    {}

    public function __get($id): ?int
    {
        return $this->$id;
    }

    public function __get($post_body): string
    {
        return $this->$post_body;
    }

    public function __get($posted_by): string
    {
        return $this->$posted_by;
    }

    public function __get($posted_to): string
    {
        return $this->$posted_to;
    }

    public function __get($date_added): DateTimeImmutable
    {
        return $this->$date_added;
    }

    public function __get($post_id): ?int
    {
        return $this->$post_id;
    }
}