<?php

namespace App\Http\Controllers;

use Exception;

abstract class Controller
{
    public function sendResponse($data = null, string|null $message = null,)
    {
        $response = ['success' => true];

        if (isset($message)) {
            $response['message'] = $message;
        }
        
        if (isset($data)) {
            $response['data'] = $data;
        }
        return response()->json($response);
    }

    public function sendError($error)
    {
        return response()->json([
            'success' => false,
            'error' => $error instanceof Exception ? $error->getMessage(): $error
        ], 400);
    }
}
