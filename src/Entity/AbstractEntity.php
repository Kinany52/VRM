<?php

declare(strict_types=1);

namespace App\Entity;

use DateTimeImmutable;

abstract class AbstractEntity
{
    public function __construct(
        private int $id,
        private string $first_name,
        private string $last_name,
        private string $username,
        private string $email,
        private string $password,
        private DateTimeImmutable $signup_date,
        private int $num_post,
        private int $num_likes,
        private bool $user_closed
    )
    {}

}

