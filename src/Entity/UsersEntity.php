<?php

declare(strict_types=1);

namespace App\Entity;

use DateTime;
use DateTimeImmutable;

class UsersEntity extends AbstractEntity
{   
    public function __construct(
        public string $first_name,
        public string $last_name,
        public string $username,
        public string $email,
        public string $password,
        public string $signup_date,
        public int $num_posts=0,
        public int $num_likes=0,
        public int $id=0,
        public string $user_closed='no'
    )
    {}
    
    public function _toArray(): array
    {
        return [$this->id, $this->first_name, $this->last_name, $this->username, $this->email, $this->password, $this->signup_date, $this->num_posts, $this->num_likes, $this->user_closed];
    }
        
}