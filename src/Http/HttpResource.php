<?php


namespace Wog\Http;


abstract class HttpResource implements HttpResourceInterface
{
    use Traits\HeadersAwareTraits;

    /**
     * HttpResource constructor.
     * @param $headers
     */
    public function __construct()
    {
        $this->headers = [];
    }

}