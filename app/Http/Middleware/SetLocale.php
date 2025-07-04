<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Cookie;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $locale  = $request->segment(1);
        $excepts = ['admin','app','api','livewire','logout','language','_debugbar','telescope','storage'];
        
        if(!in_array($locale, $excepts , true)) {
            if (!in_array($locale, config('customConfig.locales'), true)) {
                return redirect(app('locale-for-client') . '/' . request()->path());
            }
            app()->setLocale($locale);
            URL::defaults(['locale' => $request->segment(1)]);
            Cookie::queue(Cookie::make('lang', $request->segment(1), 60 * 60 * 24 * 20));
            return $next($request);
        }
        return $next($request);
    }
}
