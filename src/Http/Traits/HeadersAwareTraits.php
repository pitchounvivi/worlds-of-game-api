<?php


namespace Wog\Http\Traits;


trait HeadersAwareTraits
{

    protected
        /**
         * @var array
         */
        $headers;

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param mixed $headers
     */
    public function setHeaders($headers): void
    {
        $this->headers = $headers;
    }

}