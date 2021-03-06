<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use Auth;
use Illuminate\Http\Request;

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
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
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
        return parent::render($request, $exception);
    }

    /* Newly added codes */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
        if ($request->is('admin') || $request->is('admin/*')) {
            return redirect()->guest('/login/admin');
        }
        if ($request->is('marketing') || $request->is('marketing/*')) {
            return redirect()->guest('/login/marketing');
        }
        if ($request->is('support') || $request->is('support/*')) {
            return redirect()->guest('/login/support');
        }
        if ($request->is('customer') || $request->is('customer/*')) {
            return redirect()->guest('/login/customer');
        }
        if($exception instanceof \Illuminate\Auth\AuthenticationException)
        {
            if(\Request::is('api*'))
            {
                $message = array(
                    "error" => "invalid_credentials",
                    "message" => "The Authorization token is expired. Please login to continue."
                );
                return response($message, 401);
            } 
        }
        return redirect('/login/customer');//redirect()->guest(route('login'));
    }
}
