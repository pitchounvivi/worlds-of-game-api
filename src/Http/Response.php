<?php


namespace Wog\Http;



class Response extends HttpResource implements ResponseInterface
{
    use Traits\StatusAwareTraits;
    use Traits\BodyAwareTraits;
    use Traits\SenderTraits;

    /**
     * Response constructor.
     * @param $headers
     * @param $body
     */
    public function __construct()
    {
        parent::__construct();

        $this->statusCode = 200;
        $this->statusText = "RESPONSE OK";

        $this->headers = [
//        header("Access-Control-Allow-Origin: *"); //on accepte tout car, il n'y a pas de vrai sécurité
//        header("Access-Control-Allow-Headers: Content-Type"); //on liste les entêtes authorisées
//        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

            "Access-Control-Allow-Origin" => "*",
            "Access-Control-Allow-Headers" => "Content-Type",
            "Access-Control-Allow-Methods" => "GET, POST, PUT, DELETE, OPTIONS",
            "Content-Type" => "application/json"
        ];

        $this->body = "{}"; //on déclare la conversion en string de la stdClass (json)
    }

    /**
     * @param $message
     */
    public function setError($message) : void
    {
        $this->setBody(json_encode([
            "code " => $this->statusCode,
            "message" => $message
        ]));
    }

}