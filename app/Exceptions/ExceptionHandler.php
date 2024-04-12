<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Throwable;

class ExceptionHandler extends Exception
{
    public static function handle(Throwable $error): JsonResponse
    {
        $statusCode   = 500;
        $errorMessage = 'internal server error';

        if ($error instanceof ModelNotFoundException) {
            $statusCode   = 404;
            $errorMessage = "Not Found";
        }

        if ($error instanceof AuthenticationException) {
            $statusCode   = 403;
            $errorMessage = $error->getMessage();
        }

        return response()->json([
            'error'   => $errorMessage,
            'message' => $error->getMessage()
        ], $statusCode);
    }

    public static function throw(Throwable $error, $message): Throwable
    {
        if ($error instanceof ModelNotFoundException) {
            throw $error;
        } else if ($error instanceof AuthenticationException) {
            throw $error;
        } else {
            throw new Exception($message . ': ' . $error->getMessage());
        }
    }
}
