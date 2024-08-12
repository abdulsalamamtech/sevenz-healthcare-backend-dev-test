<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Throwable $e
     * @return \Illuminate\Http\Response|JsonResponse
     */
    public function render($request, Throwable $e)
    {
        // Custom response for all exceptions
        $response = [
            'success' => false,
            'message' => 'An error occurred. Please try again later.',
            'error' => config('app.debug') ? $e->getMessage() : 'Internal Server Error', // Avoid exposing error details in production
            'code' => $e->getCode(),
        ];

        // Set a default status code
        $statusCode = 500;

        // Customize response for different exception types

        if ($e instanceof ModelNotFoundException) {
            $response['message'] = 'Resource not found.';
            $statusCode = 404;
        } elseif ($e instanceof NotFoundHttpException) {
            $response['message'] = 'Endpoint not found.';
            $statusCode = 404;
        } elseif ($e instanceof AuthenticationException) {
            $response['message'] = 'Unauthenticated.';
            $statusCode = 401;
        } elseif ($e instanceof AuthorizationException) {
            $response['message'] = 'Unauthorized.';
            $statusCode = 403;
        } elseif ($e instanceof ValidationException) {
            $response['message'] = 'Validation failed.';
            $response['errors'] = $e->errors();
            $statusCode = 422;
        }

        // Check if the request expects a JSON response
        if ($request->expectsJson()) {
            return response()->json($response, $statusCode);
        }

        // For non-JSON requests, you can return a view or redirect
        return response()->view('errors.custom', $response, $statusCode);
    }
}
