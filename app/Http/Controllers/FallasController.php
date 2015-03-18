<?php namespace App\Http\Controllers;

use Session;
use Validator;
use Illuminate\Http\Request;

use App\Models\Falla;

class FallasController extends Controller{


	/**
		TOP Fallas
	*/

	public function displayShamefulnessList(Request $request){
		$message = Session::get('successMessage');
		$error = Session::get('errorMessage');
		$fallas = $this->getWorstFallas();
		$view = view('index')->with('fallas', $fallas);

		$haveMessage = isset($message);
		$haveError = isset($error);

		if( $haveMessage )
			return $view->with('successMessage', $message);
		else if( $haveError )
			return $view->with('errorMessage', $error);

		return $view;
	}

	public function getWorstFallas($records = 15){
		return Falla::select('id', 'name', 'address', \DB::raw('count(id_falla) as score'))
				->leftJoin('objections', 'fallas.id', '=', 'objections.id_falla')
				->where('fallas.status', '=', 1)
				->where('objections.status', '=', 1)
				->groupBy('id')
				->orderBy('score', 'DESC')
				->paginate($records);
	}

	/**
		Search Fallas
	*/

	public function displaySearchForm(){
		return view('forms.search');
	}

	public function search(Request $request){
		$name = $request->input('name');
		$address = $request->input('address');
		$anyDataSpecified = !$name && !$address;
		$anyDataSpecifiedMessage = 'Debes introducir algún dato por el cual buscar';

		if($anyDataSpecified)
			return view('forms.search')->with('errorMessage', $anyDataSpecifiedMessage);

		$fallas = Falla::select('id', 'name', 'address', \DB::raw('count(id_falla) as score'))
						->leftJoin('objections', 'fallas.id', '=', 'objections.id_falla')
						->where('fallas.status', '=', 1)
						->where('objections.status', '=', 1);

		if($name){
			$fallas = $fallas->where('name', 'LIKE', "%{$name}%");
			if($address)
				$fallas = $fallas->where('address', 'LIKE', "%{$address}%");
		}else
			$fallas = $fallas->where('address', 'LIKE', "%{$address}%");
		
		$nothingFoundMessage = 'No se encontraron coincidencias para los criterios de búsqueda introducidos';
		if(!$fallas->exists())
			return view('forms.search')->with('errorMessage', $nothingFoundMessage);

		$fallas = $fallas->groupBy('fallas.id')->orderBy('score', 'DESC')->get();
		return view('forms.search')->with('fallas', $fallas);
	}

	/**
		Create
	*/

	public function displayForm(){
		return view('forms.falla');
	}

	public function create(Request $request){
		$name = $request->input('name');
		$address = $request->input('address');

		$validator = Validator::make(
			['name' => $name,
			'address' => $address],
			['name' => 'required|max:50|unique:fallas,name',
			'address' => 'required|max:60|unique:fallas,address']
		);
		if($validator->fails())
			return view('forms.falla')->with('errorMessage', 'Datos inválidos');

		$falla = new Falla([
				'name' => $name,
				'address' => $address,
				'status' => 1
			]);
		$falla->save();

		return redirect()->route('moansForm')->with('idFalla', $falla->id)
						->with('successMessage', 'Falla creada satisfactoriamente. ¡Quéjate ahora!');
	}
}