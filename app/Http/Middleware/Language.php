<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Config;
use App;

class Language
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
        public function handle($request, Closure $next)
        {
            if(Session::has('locale'))
            {
                $locale1=Session::get('locale',config::get('app.locale'));
            }
            else {
                $locale1=2;
            }
            if ($locale1 ==1)
            {
                $locale='ar';
            }
            else
            {
                $locale='en';
            }
            App::setlocale($locale);
            return $next($request);
        }
}
