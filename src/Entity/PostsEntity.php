<?php

declare(strict_types=1);

namespace App\Entity;

use DateTime;
use DateTimeInterface;

class PostsEntity extends AbstractEntity
{
    public function __construct(
        public int $id,
        public string $body,
        public string $added_by,
        public DateTime $date_added,
        public string $deleted='no',
        public int $likes=0
    )
    {}

    public function _toArray(): array
    {
        $attributes = [$this->id, $this->body, $this->added_by, $this->date_added, $this->deleted, $this->likes];
        return $this->prepareAttributeForPersisting($attributes);
    }
}

