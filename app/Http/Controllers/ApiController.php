<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function responseJson($status = false, $message = null, $data = null, $code)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    // Response Error

    public function responseBadRequest($message = 'Bad Request', $data = null)
    {
        return $this->responseJson(false, $message, $data, 400);
    }

    public function responseUnauthorized($message = 'Unauthorized', $data = null)
    {
        return $this->responseJson(false, $message, $data, 401);
    }

    public function responseForbidden($message = 'Forbidden', $data = null)
    {
        return $this->responseJson(false, $message, $data, 403);
    }

    public function responseNotFound($message = 'Not Found', $data = null)
    {
        return $this->responseJson(false, $message, $data, 404);
    }

    public function responseValidationError($message = 'Validation Error', $data = null)
    {
        return $this->responseJson(false, $message, $data, 422);
    }

    public function responseServerError($message = 'Server Error', $data = null)
    {
        return $this->responseJson(false, $message, $data, 500);
    }

    // Response Success

    public function responseSuccess($message, $data)
    {
        return $this->responseJson(true, $message, $data, 200);
    }

    public function responseCreated($message, $data)
    {
        return $this->responseJson(true, $message, $data, 201);
    }
}
