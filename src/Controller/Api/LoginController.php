<?php


namespace Wog\Controller\Api;

use Wog\Controller\Controller;
use Wog\Http\RequestInterface;
use Wog\Http\ResponseInterface;
use Wog\Repository\UserRepository;

class LoginController extends Controller
{
    /**
     * LoginController constructor.
     * @param RequestInterface $request
     * @param ResponseInterface $response
     */
    public function __construct(
        RequestInterface $request,
        ResponseInterface $response)
    {
        parent::__construct($request,$response);
    }

    public function retrieve(int $id = null): ResponseInterface
    {
        try {
            if (
                !array_key_exists("email", $this->request->get()) ||
                !array_key_exists("password", $this->request->get())
            ) {
                $this->response->setStatus(422, "Unprocessable Entity");
                $this->response->setError("The User is incomplete : missing parameters");
                return $this->response;
            }

            $repository = new UserRepository();

            //après avoir hash le password, on ne peut plus comparer le password (car le hash est légèrement variable)
//            $user = $repository->selectByEmailAndPassword(
//                $this->request->get()["email"],
//                $this->request->get()["password"]
//            );

            //on ne plus désormais vérifier que l'email
            $user = $repository->selectByEmail($this->request->get()["email"]);

            //on vérifie le password
            if (!password_verify($this->request->get()["password"], $user->getPassword())) {
                //pour gérer l'erreur 404
                throw new \TypeError();
            }

            //pour récupérer le token quand on a un user déjà connu
            //on récupère une string qui représente le model en json
            $jsonString = json_encode($user);

            //convertir cette string en objet ouvert
            $jsonObj = json_decode($jsonString);

            //ajouter le token à cet objet
            $jsonObj->token = $user->getToken();

//            en plus court
//            $json = json_decode(json_encode($user));
//            $json->token = $user->getToken();
//            $this->response->setBody(json_encode($json));

            $this->response->setStatus(200, "Login OK");
            $this->response->setBody(json_encode($jsonObj));

        }catch (\TypeError $e){

            $this->response->setStatus(404, " USER Not found");
            $this->response->setError(
                "The USER for URI "
                . $this->request->getUri()
                . "?email=" . $this->request->get()["email"]
                . "&password=" . $this->request->get()["password"]
                . " is not Found");
        }
        //autre formulation requête
//        "The URI "
//        . $this->request->getUri()
//        . "?"
//        . http_build_query($this->request->get())
//        ." is not Found");

        return $this->response;
    }

    public function create(): ResponseInterface
    {
        // TODO: Implement create() method.
    }

    /**
     * Triggered for PUT HTTP method
     *
     * Responsible to query a model and put it in the response body
     * Must retrieve 200 response for created resource
     * Must retrieve 422 unprocessable entity
     * Must retrieve 409 conflict
     *
     * @return Response
     *
     * @throws \PDOException for all pdo errors except constraint integrity violation
     */
    public function update(): ResponseInterface
    {
        // TODO: Implement update() method.
    }

    /**
     * Triggered for DELETE HTTP method
     *
     * Responsible to query a model and put it in the response body
     * Must retrieve 200 response for created resource
     * Must retrieve 404 response for not found resource
     *
     * @param int|null $id
     * @return Response
     *
     * @throws \PDOException for all pdo throwable
     */
    public function delete(int $id = null): ResponseInterface
    {
        // TODO: Implement delete() method.
    }
}