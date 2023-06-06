<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {

        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        if ($request->is('admin') || $request->is('admin/*')) {
            return redirect()->guest(route('admin.login'));
        }

        if ($request->is('branch-level') || $request->is('branch-level/*')) {
            return redirect()->guest(route('branch-level.login'));
        }

        if ($request->is('division-manager') || $request->is('division-manager/*')) {
            return redirect()->guest(route('division-manager.login'));
        }

        if ($request->is('hq') || $request->is('hq/*')) {
            return redirect()->guest(route('hq.login'));
        }

        return redirect()->guest(route('login'));
    }
}
