<?php

declare(strict_types=1);

namespace App\Entity;

use DateTime;
use DateTimeInterface;

class CommentsEntity extends AbstractEntity
{
    public function __construct(
        public int $id,
        public string $post_body,
        public string $posted_by,
        public string $posted_to,
        public DateTime $date_added,
        public int $post_id
    )
    {}

    public function _toArray(): array
    {
        $attributes = [$this->id, $this->post_body, $this->posted_by, $this->posted_to, $this->date_added, $this->post_id];
        return $this->prepareAttributeForPersisting($attributes);
    }
}