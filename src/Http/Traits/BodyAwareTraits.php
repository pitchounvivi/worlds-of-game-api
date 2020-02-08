<?php


namespace Wog\Http\Traits;


trait BodyAwareTraits
{
    private

        /**
         * @var string
         */
        $body;


    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param string $body
     */
    public function setBody(string $body)
    {
        $this->body = $body;
    }
}