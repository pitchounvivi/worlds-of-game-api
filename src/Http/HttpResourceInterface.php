<?php


namespace Wog\Http;


interface HttpResourceInterface
{
    /**
     * @return array
     */
    public function getHeaders(): array;

    /**
     * @param mixed $headers
     */
    public function setHeaders($headers): void;
}