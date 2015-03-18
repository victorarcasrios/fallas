<?php namespace App\Http\Middleware;

use Closure;

class OnlyGuestMiddleware{

	public function handle($request, Closure $next)
	{
		$successMessage = 'Ya te encuentras identificado';
		
		$isUserAlreadyLogged = \Auth::check();
		if( $isUserAlreadyLogged )
			return redirect()->route('index')->with('successMessage', $successMessage);

		return $next($request);
	}
}