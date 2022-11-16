<?php

namespace Core\Http;

class Request
{
    protected string $queryString;

    public function __construct(array $server) {
        if (!array_key_exists('QUERY_STRING', $server)) {
            throw new \InvalidArgumentException('$server variable does not contain QUERY_STRING');
        }
        $this->queryString = $server['QUERY_STRING'];
    }

    public function getQueryString(): string
    {
        return $this->queryString;
    }
}