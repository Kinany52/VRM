<?php

declare(strict_types=1);

namespace App\Entity;

class LikesEntity extends AbstractEntity
{
    public function __construct(
        public string $username,
        public int $post_id,
        public int $id=0,
    )
    {}

    public function _toArray(): array
    {
        return [$this->id, $this->username, $this->post_id];
    }
}