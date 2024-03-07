<?php

namespace App\Http\Middleware;

use App\Traits\JsonErrorResponseTrait;
use App\Traits\JsonResponseTrait;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Response;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            abort(Response::HTTP_UNAUTHORIZED, __('auth.fail'));
        }

    }
}
