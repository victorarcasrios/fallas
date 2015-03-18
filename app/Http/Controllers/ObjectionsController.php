<?php namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;

use App\Models\Falla;
use App\Models\Objection;

class ObjectionsController extends Controller{

	public function displayMoansForm(){
		$idFalla = \Session::get('idFalla');
		$fallaSpecified = isset($idFalla);
		$successMessage = \Session::get('successMessage');
		$errorMessage = \Session::get('errorMessage');
		$view = view('forms.moan')->with('fallas', Falla::get());

		$hasMessage = isset($successMessage);
		$hasError = isset($errorMessage);

		$view = $view->with('idFalla', $idFalla);

		if($hasMessage)
			return $view->with('successMessage', $successMessage);
		else if($hasError)
			return $view->with('errorMessage', $errorMessage);

		return $view;
	}

	public function createMoan(Request $request){
		$user = \Auth::user();
		$idFalla = $request->input('falla');
		$falla = Falla::find($idFalla);
		$text = $request->input('text');

		$validator = Validator::make(
			['id_falla' => $idFalla, 'text' => $text],
			['id_falla' => 'required|numeric|exists:fallas,id', 'text' => 'between:20,500']
		);
		if($validator->fails())
			return redirect()->route('moansForm')
						->with('errorMessage', 'Datos inválidos. Preste atención a las reglas');

		$userHasAlreadyMoaned = Objection::where('id_falla', '=', $idFalla)->where('id_user', '=', $user->id)->exists();
		if($userHasAlreadyMoaned)
			return redirect()->route('moansForm')
							->with('errorMessage', 'Ya te has quejado de esta falla');

		Objection::create([
			'id_falla' => $falla->id,
			'id_user' => $user->id,
			'text' => $text,
			'status' => 1
			]);

		return redirect()->route('moansIndex')->with('successMessage', 'Queja publicada satisfactoriamente');
	}

	public function displayMoansList(){
		$moans = Objection::select('text', \DB::raw('users.name as author'), 
							\DB::raw('fallas.name as falla'), 'objections.created_at')
							->join('fallas', 'id_falla', '=', 'fallas.id')
							->join('users', 'id_user', '=', 'users.id')
							->where('fallas.status', '=', 1)
							->where('users.status', '=', 1)
							->where('objections.status', '=', 1)
							->orderBy('objections.created_at', 'DESC')
							->get();

		return view('moans')->with('moans', $moans);
	}

}