<?php

namespace App\Http\Middleware;
use App;
use Auth;
use Closure;
use Redirect;
use Request;
use Role;

class RoleUpdate {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$module_slug) {
		$role_access = Role::access('u',$module_slug);
        if(!$role_access) {
            return Redirect::intended('/404');
        }
        return $next($request);
    }
}
