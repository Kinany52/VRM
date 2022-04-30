<?php

declare(strict_types=1);

namespace App\Entity;

class UsersEntity extends AbstractEntity
{
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

    public function __get($signup_date): ?int
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