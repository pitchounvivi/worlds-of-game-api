<?php


namespace Wog\Controller;


use Wog\Http\ResponseInterface;

interface CRUDControllerInterface
{
    /**
     * Triggered for GET HTTP method
     *
     * Responsible to query a model and put it in the response body
     * Must retrieve 200 response for found resource
     * Must retrieve 404 response for not found resource
     *
     * @param int|null $id
     * @return ResponseInterface
     *
     * @throws \PDOException for all pdo errors
     */
    public function retrieve(int $id = null): ResponseInterface;

    /**
     * Triggered for POST HTTP method
     *
     * Responsible to query a model and put it in the response body
     * Must retrieve 201 response for created resource
     * Must retrieve 422 unprocessable entity
     * Must retrieve 409 conflict
     *
     * @return ResponseInterface
     *
     * @throws \PDOException for all pdo throwables except constraint integrity violation
     */
    public function create(): ResponseInterface;

    /**
     * Triggered for PUT HTTP method
     *
     * Responsible to query a model and put it in the response body
     * Must retrieve 200 response for created resource
     * Must retrieve 422 unprocessable entity
     * Must retrieve 409 conflict
     *
     * @return ResponseInterface
     *
     * @throws \PDOException for all pdo errors except constraint integrity violation
     */
    public function update(): ResponseInterface;

    /**
     * Triggered for DELETE HTTP method
     *
     * Responsible to query a model and put it in the response body
     * Must retrieve 200 response for created resource
     * Must retrieve 404 response for not found resource
     *
     * @param int|null $id
     * @return ResponseInterface
     *
     * @throws \PDOException for all pdo throwable
     */
    public function delete(int $id = null): ResponseInterface;
}