<?php

declare(strict_types=1);

namespace App\Entity;

class UsersEntity extends AbstractEntity
{   
    public function __construct(
        public readonly int $id,
        public readonly string $first_name,
        public readonly string $last_name,
        public readonly string $username,
        public readonly string $email,
        public readonly string $password,
        public readonly DateTimeImmutable $signup_date,
        public readonly int $num_post,
        public readonly int $num_likes,
        public readonly bool $user_closed
    )
    {}

    public function __get($id): ?int
    {
        return $this->$id;
    }

    public function __get($first_name): string
    {
        return $this->$first_name;
    }

    public function __get($last_name): string
    {
        return $this->$last_name;
    }

    public function __get($username): string
    {
        return $this->$username;
    }

    public function __get($email): string
    {
        return $this->$email;
    }

    public function __get($password): string
    {
        return $this->$password;
    }

    public function __get($signup_date): DateTimeImmutable
    {
        return $this->$signup_date;
    }

    public function __get($num_posts): ?int
    {
        return $this->$num_posts;
    }

    public function __get($num_likes): ?int
    {
        return $this->$num_likes;
    }

    public function __get($user_closed): bool
    {
        return $this->$user_closed;
    }
}