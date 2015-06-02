<?php namespace App\Http\Middleware;

use App\Recipe;
use Closure;
use Illuminate\Support\Facades\Auth;

class MustBeOwner {

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

        // User is admin - send them on
        if ($user->is_admin) {
            return $next($request);
        }

        $routeParameters = $request->route()->parameters();
        // $key = route, $value = id
        foreach ($routeParameters as $key => $value) {
            if ($key == 'users') {
                // If these are the same, user is accessing their own record
                if ( (int) $value === (int) $user->id) {
                    return $next($request);
                }

                // Otherwise, send them back to their own record
                return redirect('users/' . $user->id);
            }
            if ($key == 'recipes') {
                $recipe = Recipe::findOrFail($value);

                // If these are the same, user is accessing a recipe they created
                if ($recipe->user_id === $user->id) {
                    return $next($request);
                }
                return redirect('recipes');
            }
        }

        return redirect('/');
	}

}
