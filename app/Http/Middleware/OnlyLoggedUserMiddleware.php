<?php namespace App\Http\Middleware;

use Closure;

class OnlyLoggedUserMiddleware{

	public function handle($request, Closure $next)
	{
		$errorMessage = 'Debes estar identificado para realizar esta acción';
		$isUserNotLogged = !( \Auth::check() );

		if( $isUserNotLogged )
			return redirect()->route('index')->with('errorMessage', $errorMessage);

		return $next($request);
	}
}