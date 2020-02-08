<?php


namespace Wog\Http;


interface RequestInterface
{

    /**
     * @return string
     */
    public function getUri(): string;

    /**
     * @return array
     */
    public function getHeaders(): array;

    /**
     * @return string
     */
    public function getMethod(): string;

    /**
     * @return mixed
     */
    public function get();

    /**
     * @return array avaible only if header Content-Type: application/x-www-form-urlencoded is send
     */
    public function post();

    /**
     * @return \stdClass not empty if data send is a JSON string
     */
    public function json(): \stdClass;


}