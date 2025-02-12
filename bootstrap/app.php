<?php

use App\Exceptions\HandleNotFoundException;
use App\Helpers\Helper;
use App\Http\Middleware\BeforeHandleModelNotFound;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            return response()->json([
                'status' => Response::HTTP_NOT_FOUND,
                'message' => 'Arquivo não localizado'
            ], Response::HTTP_NOT_FOUND);
        });
        $exceptions->render(function (UniqueConstraintViolationException $ex, Request $request) {
            $exception = Helper::TratarExceptionComDadosDuplicados($ex->getMessage());
            return response()->json($exception, Response::HTTP_CONFLICT);
        });
    })->create();
