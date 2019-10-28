<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;

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
        public function render($request, Exception $e)
    {
        if ($request->wantsJson()) {
            return response()->json(
                $this->getJsonMessage($e),
                $this->getExceptionHTTPStatusCode($e)
            );
        }
        return parent::render($request, $e);
    }

        protected function getJsonMessage($e){
        return [
            'error' => method_exists($e, 'getStatusCode') ?
                Response::$statusTexts[$e->getStatusCode()]
                : $e->getMessage()
        ];
    }

        protected function getExceptionHTTPStatusCode($e){
        return method_exists($e, 'getStatusCode') ?
            $e->getStatusCode() : 500;
    }
}
