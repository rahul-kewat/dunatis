<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class SetLogoConfigForUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $authorizedUser = Auth::user();

//        if (!App::runningInConsole() && !is_null($authorizedUser) && !empty($authorizedUser->property->logo)) {
//            Config::set('nova.brand.logo','https://staging.dunatis.app/storage/hpEi2RqAB4X7LjA3W8xFOahuGhEAat8SJztrN0mj.svg');
//        }

        return $next($request);
    }
}
