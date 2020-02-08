<?php


namespace Wog\Http\Traits;


trait StatusAwareTraits
{
    protected
        /**
         * @var int
         */
        $statusCode,

        /**
         * @var string
         */
        $statusText; //le bon nom est resolvePhrase


    /**
     * @param int $statusCode
     * @param string $statusText
     */
    public function setStatus(int $statusCode, string $statusText): void
    {
        $this->statusCode = $statusCode;
        $this->statusText = $statusText;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->statusCode . " " . $this->statusText;
        //Autre écriture
        //"$this->statusCode $this->statusText"
    }
}