<?php


namespace Wog\Http;


class Request implements RequestInterface
{
    private

        /**
         * @var string
         */
        $uri,

        /**
         * @var array
         */
        $headers,

        /**
         * @var string
         */
        $method,

        /**
         * @var array
         * car on la récupère dans $GET qui est un tableau
         */
        $get,

        /**
         * @var array
         * car on la récupère dans $POST qui est un tableau
         */
        $post,

        /**
         * @var \stdClass
         */
        $json;


    public function __construct()
    {
        $this->method = strtolower($_SERVER["REQUEST_METHOD"]);
        $this->uri = explode("?", $_SERVER["REQUEST_URI"])[0];
        $this->headers = [];
        foreach ($_SERVER as $key => $value) {
            $keys = explode("_", $key);
            if ("HTTP" !== $keys[0]) {
                continue;
            }
            array_shift($keys);
            foreach ($keys as $subKey => $subValue) {
                $keys[$subKey] = ucfirst(strtolower($subValue));
            }
            $this->headers[implode("-", $keys)] = $value;
        }

        $this->get = $_GET;
        $this->post = $_POST;
        $this->json = json_decode(stream_get_contents(fopen("php://input", "r")));
        if (null === $this->json) {
            $this->json = new \stdClass(); //cela permet d'avoir toujours quelque chose dans le body (même un objet vide)
        }
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return mixed
     */
    public function get()
    {
        return $this->get;
    }

    /**
     * @return array avaible only if header Content-Type: application/x-www-form-urlencoded is send
     */
    public function post()
    {
        return $this->post;
    }

    /**
     * @return \stdClass not empty if data send is a JSON string
     */
    public function json(): \stdClass
    {
        return $this->json;
    }


}