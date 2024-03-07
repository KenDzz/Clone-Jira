<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;


class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    private $HEADER_NAME_LANGUAGE = 'X-LOCALIZATION';

    private $arrayMultiLanguage = ['en', 'vi'];

    private $DEFAULT_LOCALE = "vi";

    public function handle(Request $request, Closure $next)
    {
        $langValue = ($request->hasHeader($this->HEADER_NAME_LANGUAGE)) ? $request->header($this->HEADER_NAME_LANGUAGE) : $this->DEFAULT_LOCALE;
        if (!in_array($langValue, $this->arrayMultiLanguage)) {
            abort(Response::HTTP_FORBIDDEN, 'Access denied');
        }
        App::setLocale($langValue);
        return $next($request);
    }
}
