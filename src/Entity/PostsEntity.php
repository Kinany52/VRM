<?php

declare(strict_types=1);

namespace App\Entity;

class PostsEntity extends AbstractEntity
{
    public function __construct(
        public string $body,
        public string $added_by,
        public mixed $date_added,
        public int $id=0,
        public string $deleted='no',
        public int $likes=0
    )
    {}

    public function toArray(): array
    {
        return [$this->id, $this->body, $this->added_by, $this->date_added, $this->deleted, $this->likes];
    }
}

