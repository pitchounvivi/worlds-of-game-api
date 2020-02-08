<?php


namespace Wog\Controller\Api;

use Wog\Controller\Controller;
use Wog\Http\RequestInterface;
use Wog\Http\ResponseInterface;
use Wog\Model\UserModel;
use Wog\Repository\UserRepository;

class UserController extends Controller
{
    /**
     * UserController constructor.
     * @param RequestInterface $request
     * @param ResponseInterface $response
     */
    public function __construct(
        RequestInterface $request,
        ResponseInterface $response)
    {
        parent::__construct($request,$response);
    }

    public function create(): ResponseInterface
    {
        try {
            //on déclare le modèle
            $user = new UserModel($this->request->json());
            //var_dump($user);

            //on valide la modèle
            if (
                !$user->getEmail() ||
                !$user->getPassword() ||
                !$user->getSurname() ||
                !$user->getFirstName() ||
                !$user->getLastName() ||
                !$user->getPhone() ||
                !$user->getAdress() ||
                !$user->getCity() ||
                !$user->getZip()
            ) {
                $this->response->setStatus(422, "Unprocessable Entity");
                $this->response->setError("The User is incomplete : missing parameters");
                return $this->response;
            }
            $user->setPassword(password_hash($user->getPassword(), PASSWORD_DEFAULT));
            $user->setToken(md5($user->getPassword())); //on rehash le mot de passe

            //on execute la requête SQL
            $repository = new UserRepository();
            $repository->insert($user);
            //var_dump($repository);

            $this->response->setStatus(201,"User created");

            $this->response->setBody(json_encode($user));

        }
        catch(\PDOException $e)
        {
            //on essaye d'insérer quelque chose qui existe déjà : code SQL 23000
            if ("23000" !== $e->getCode()){
                //var_dump("Erreur : " . $e->getMessage());
                throw $e;
            }
            $this->response->setStatus(409,"User already exist");
            $this->response->setError("The User already exist");
        }
        return $this->response;
    }


    public function retrieve(int $id = null): ResponseInterface
    {
//        var_dump($id);
//        exit();

        try{
            //on execute la requête SQL
            $repository = new UserRepository();

            $data = !$id ? $repository->select() : $repository-> selectOne($id);
            $this->response->setBody(json_encode($data));
        }
        catch (\TypeError $e){
            $this->response->setStatus(404,"User not found");
            $this->response->setError("The User : $id Not Found");
        }
        return $this->response;
    }

    public function update(): ResponseInterface
    {

    }

    public function delete(int $id = null): ResponseInterface
    {
        //die("delete method");

        try {
            if (!array_key_exists("token", $this->request->get())) {
                $this->response->setStatus(401, "Unauthorized");
                $this->response->setError("The Token is required");
                return $this->response;
            }
            $repository = new UserRepository();
            $user = $repository->deleteOne($id, $this->request->get()["token"]);

            $this->response->setStatus(202, "Success");
            $this->response->setBody(json_encode($user));

        }catch (\TypeError $e) {
            $this->response->setStatus(403, "Forbidden");
            $this->response->setError("Token does not match with id");
        }
        return $this->response;
    }

}