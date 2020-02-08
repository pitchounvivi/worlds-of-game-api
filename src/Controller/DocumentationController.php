<?php


namespace Wog\Controller;

use Wog\Http\RequestInterface;
use Wog\Http\ResponseInterface;

class DocumentationController extends Controller
{
    /**
     * DocumentationController constructor.
     * @param RequestInterface $request
     * @param ResponseInterface $response
     */
    public function __construct(
        RequestInterface $request,
        ResponseInterface $response)
    {
        parent::__construct($request,$response);
    }


    /**
     * @param int|null $id
     * @return ResponseInterface
     * @inheritDoc
     */
    public function retrieve(int $id = null): ResponseInterface
    {
//        //récupérer le controller
////        $path = __DIR__."/../../src/Controller/DocumentationController.php";
////        return $this->render($path);

        return $this->render(
            "documentation/retrieve.html.php",
            [
                "routes" => json_decode(file_get_contents(
                    __DIR__."/../../config/routes.json"
                ))
            ]
        );
    }

    /**
     * @return ResponseInterface
     */
    public function create(): ResponseInterface
    {
        // TODO: Implement create() method.
    }

    /**
     * @return ResponseInterface
     */
    public function update(): ResponseInterface
    {
        // TODO: Implement update() method.
    }

    /**
     * @param int|null $id
     * @return ResponseInterface
     */
    public function delete(int $id = null): ResponseInterface
    {
        // TODO: Implement delete() method.
    }
}