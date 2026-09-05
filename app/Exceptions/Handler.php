<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

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
     * Register the exception handling callbacks.
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        /*
        |--------------------------------------------------------------------------
        | ValidationException
        |--------------------------------------------------------------------------
        */

        $this->renderable(function (
            ValidationException $e,
            $request
        ) {

            if ($request->expectsJson()) {

                return response()->json([
                    'success' => false,
                    'message' => 'Error de validación.',
                    'errors' => $e->errors()
                ], 422);

            }

        });

        /*
        |--------------------------------------------------------------------------
        | AuthenticationException
        |--------------------------------------------------------------------------
        */

        $this->renderable(function (
            AuthenticationException $e,
            $request
        ) {

            if ($request->expectsJson()) {

                return response()->json([
                    'success' => false,
                    'message' => 'No autenticado.',
                    'errors' => null
                ], 401);

            }

        });

        /*
        |--------------------------------------------------------------------------
        | NotFoundHttpException
        |--------------------------------------------------------------------------
        */

        $this->renderable(function (
            NotFoundHttpException $e,
            $request
        ) {

            if ($request->expectsJson()) {

                return response()->json([
                    'success' => false,
                    'message' => 'Recurso no encontrado.',
                    'errors' => null
                ], 404);

            }

        });

        /*
        |--------------------------------------------------------------------------
        | ModelNotFoundException
        |--------------------------------------------------------------------------
        */

        $this->renderable(function (
            ModelNotFoundException $e,
            $request
        ) {

            if ($request->expectsJson()) {

                return response()->json([
                    'success' => false,
                    'message' => 'Registro no encontrado.',
                    'errors' => null
                ], 404);

            }

        });

        /*
        |--------------------------------------------------------------------------
        | Error 500
        |--------------------------------------------------------------------------
        */

        $this->renderable(function (
            Throwable $e,
            $request
        ) {

            if ($request->expectsJson()) {

                return response()->json([
                    'success' => false,
                    'message' => 'Ocurrió un error interno del servidor.',
                    'errors' => null
                ], 500);

            }

        });
    }
}