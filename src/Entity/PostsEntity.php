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
    
    /*
    public function __get($property) 
    {
        if(property_exists($this, $property)) {
            return $this->{$property};
        }
        throw new InvalidArgumentException();
    }
    
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
        return $this->added_by;
    }
   
    public function __get($date_added): mixed
    {
        return $this->$date_added;
    }

    public function __get($deleted): mixed
    {
        return $this->$deleted;
    }

    public function __get($likes): ?int
    {
        return $this->$likes;
    }
    */
}

