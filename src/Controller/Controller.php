<?php


namespace Wog\Controller;


use Wog\Http\RequestInterface;
use Wog\Http\ResponseInterface;

abstract class Controller implements CRUDControllerInterface
{
    protected
        /**
         * @var RequestInterface
         */
        $request,

        /**
         * @var ResponseInterface
         */
        $response;

    /**
     * Controller constructor.
     * @param RequestInterface $request
     * @param ResponseInterface $response
     */
    public function __construct(
        RequestInterface $request,
        ResponseInterface $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function render(string $path, array $data = null): ResponseInterface
    {
        extract($data);

        ob_start(); //ouverture tampon

        //include __DIR__."/../../template/documentation/retrieve.html.php"; //on dit quel fichier on veut
        include __DIR__."/../../template/$path"; //on dit quel fichier on veut

        $body = ob_get_contents();//on récupère le contenu

        ob_end_clean();//fermeture tampon

        //on lui rajoute juste une entête pour que notre setBody puisse avoir du string
        $headers = $this->response->getHeaders();
        $headers["Content-type"] = "text/html";
        $this->response->setHeaders($headers);
        //var_dump($this->response->getHeaders());

        $this->response->setBody($body);//envoie dans corps
        return $this->response;//envoie de la réponse
    }

}