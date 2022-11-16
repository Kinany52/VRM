<?php

namespace Core\Http;

class Header
{
    public function __construct(
        public readonly string $name,
        public readonly string|int $value,
    ) {

    }
}