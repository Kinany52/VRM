<?php

namespace Core\Http;

class Response
{
    private array $headers = [];

    public function __construct(
        public readonly int $httpStatus = 200,
        public mixed $content = null,
    ) {}

    public function addHeader(Header $header): self
    {
        $this->headers[] = $header;

        return $this;
    }

    /**
     * @return Header[]
     */
    public function getHeaders(): iterable
    {
        return $this->headers;
    }

    public function setContent(mixed $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getContent(): mixed
    {
        return $this->content;
    }
}