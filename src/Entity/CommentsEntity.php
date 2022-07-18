<?php

declare(strict_types=1);

namespace App\Entity;

class CommentsEntity extends AbstractEntity
{
    public function __construct(
        public string $post_body,
        public string $posted_by,
        public string $posted_to,
        public mixed $date_added,
        public int $post_id,
        public int $id=0,
    )
    {}

    public function toArray(): array
    {
        return [$this->id, $this->post_body, $this->posted_by, $this->posted_to, $this->date_added, $this->post_id];
    }
}