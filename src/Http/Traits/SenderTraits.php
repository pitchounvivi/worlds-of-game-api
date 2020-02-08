<?php


namespace Wog\Http\Traits;


trait SenderTraits
{


    /**
     *
     */
    public function send(): void
    {
        header("HTTP/1.1 " . $this->getStatus()); // penser à l'espace après HTTP/1.1
        foreach ($this->getHeaders() as $key => $value) {
            header("$key: $value");
        }
        echo $this->getBody(); //json_encode transforme un objet en chaine de caractère
    }
}