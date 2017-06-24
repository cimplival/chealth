<?php

namespace App\Exceptions;

use Exception;
use Redirect;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        switch($e){
            case ($e instanceof ModelNotFoundException):
               return response()->view('errors.404', [], 404);
            break;
            case ($e instanceof \Illuminate\Session\TokenMismatchException):
               return redirect()
                  ->back()
                  ->withInput($request->except('_token'))
                  ->withMessage('Sorry, the form you used expired. Kindly, re-enter all the details again in the form.');
            break;
            case ($e instanceof ErrorException):
                return redirect()->route('home-redirect')
                >withMessage('Sorry, the session expired. Kindly, sign in again.');
            break;
            default:
                return parent::render($request, $e);
        }
    }

    protected function renderException($e)
    {

        switch ($e){
            case ($e instanceof ModelNotFoundException):
               return response()->view('errors.404', [], 404);
            break;
            default:
                return response()->view('errors.404', [], 404);
        }

    }
}
