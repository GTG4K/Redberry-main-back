<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureEmailIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() && !$request->user()->hasVerifiedEmail()) {

            $frontendURL = env('FRONTEND_URL');
            $queryParameters = http_build_query(['dialog' => 'activate_account']);
            $redirectURL = "{$frontendURL}?{$queryParameters}";

            return redirect()->away($redirectURL);
        }
        return $next($request);
    }
}
