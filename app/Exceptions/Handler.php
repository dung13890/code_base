<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
        \App\Exceptions\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof AuthenticationException) {
            return $this->unauthenticated($request, $exception);
        }

        if ($request->expectsJson()) {
            return $this->formatRender($exception);
        }

        return parent::render($request, $exception);
    }

    public function formatRender(Exception $exception)
    {
        $arrayCodeHttp = ['401', '403', '404', '422', '500'];
        $code = $exception->getCode();
        
        if (!in_array($code, $arrayCodeHttp)) {
            $code = 500;
        }

        $response = [
            'message' => [
                'status' => false,
                'code' => $code,
                'description' => $exception->getMessage(),
            ]
        ];

        if ($exception instanceof ValidationException) {
            $code = 422;
            $response['message']['code'] = 422;
            $response['description']['validator'] = $exception->validator->errors()->all();
        }

        return response()->json($response, $code);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json([
                'message' => [
                    'status' => false,
                    'code' => 401,
                    'description' => 'Unauthenticated',
                ]
            ], 401);
        }

        return redirect()->guest(route('login'));
    }
}
