<?php
namespace App\Http\Controllers;

use Response;
use Symfony\Component\HttpFoundation\Response as Res;

/**
 * Class ApiControllerTrait
 * @package App\Http\Controllers
 */
trait ApiControllerTrait
{
    /**
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseOk($message = '')
    {
        return Response::json($message);
    }

    /**
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseCreated($message = '')
    {
        return Response::json($message, Res::HTTP_CREATED);
    }

    /**
     * Use this when user requests input form. 
     *
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseFormed($form = '')
    {
        $response = [
            'form' => $form,
        ];
        return Response::json($response, Res::HTTP_CREATED);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseNotFound()
    {
        return Response::json(null, Res::HTTP_NOT_FOUND);
    }

    /**
     * @param array $messages
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseValidationError($messages = [])
    {
        return $this->responseBadRequest('validation', $messages);
    }

    /**
     * @param null $error
     * @param array $messages
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseBadRequest($error = null, $messages = [])
    {
        $response = [
            'error' => $error,
            'messages' => $messages,
        ];
        return Response::json($response, Res::HTTP_BAD_REQUEST);
    }

    /**
     * @param array $messages
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseMethodNotAllowed($messages = [])
    {
        $response = [
            'messages' => $messages,
        ];
        return Response::json($response, Res::HTTP_METHOD_NOT_ALLOWED);
    }
}