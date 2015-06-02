<?php namespace App\Http\Middleware;

use App\Recipe;
use Closure;
use Illuminate\Support\Facades\Auth;

class MustBeAdministrator {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		$user = Auth::user();

        // Not logged in
        if ( ! $user) {
            return redirect()->guest('auth/login');
        }

        // User is admin: access granted
        if ($user->is_admin) {
            return $next($request);
        }

        // Silently fail and redirect to home page
        return redirect('/');
	}

}
