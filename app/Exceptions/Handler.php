<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($request->expectsJson()) {
            if ($exception instanceof AuthenticationException) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unauthenticated',
                    'errors' => [
                        'Unauthenticated'
                    ]
                ], 401);
            }

            if ($exception instanceof AuthorizationException) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'This action is unauthorized.',
                    'errors' => [
                        'This action is unauthorized.'
                    ]
                ], 403);
            }

            if ($exception instanceof ModelNotFoundException) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Entry for ' . str_replace('App\\Models\\', '', $exception->getModel()) . ' not found',
                    'errors' => [
                        'Entry for ' . str_replace('App\\Models\\', '', $exception->getModel()) . ' not found'
                    ]
                ], 404);
            }

            if ($exception instanceof ValidationException) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'The given data was invalid.',
                    'errors' => collect($exception->errors())->flatten()
                ], 422);
            }
        }

        return parent::render($request, $exception);
    }
}
