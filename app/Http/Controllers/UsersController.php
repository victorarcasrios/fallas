<?php namespace App\Http\Controllers;

use Mail;
use Validator;
use Illuminate\Http\Request;

use App\Models\User;

class UsersController extends Controller{

	const STATUS_ACTIVE = 1;
	const STATUS_BANNED = 0;

	/**
		User register
	*/

	public function displayForm(){
		return view('forms.signup');
	}

	public function submitForm(Request $request){
		$name = $request->input('name');
		$email = $request->input('email');
		$password = $request->input('password');

		$validator = $this->getSignupValidator($name, $email, $password);
		if($validator->fails())
			return redirect()->back()
					->with('errorMessage', 'Datos inválidos')
					->withErrors($validator);

		if($password !== $request->input('repeatPassword'))
			return view('forms.signup')->with('errorMessage', 'Ambas contraseñas no coinciden');

		$credentials = $this->createUserAndGetCredentials($name, $email, $password);

		$this->mailActivationToken($credentials['id'], $email, $name, $credentials['token']);
		
		$message = 'Has sido registrado correctamente.';
		$message.= ' Por favor, accede a tu email y confirma tu registro clicando';
		$message.= ' en el enlace del correo que te acabamos de enviar';
		return redirect()->route('index')->with('successMessage', $message);
	}

	private function getSignupValidator($name, $email, $password){
		return Validator::make(
			[
			'name' => $name,
			'email' => $email,
			'password' => $password
			],
			[
			'name' => 'required|min:5|max:20|unique:users',
			'email' => 'required|email|unique:users',
			'password' => 'required|min:8'
			]
		);
	}

	private function createUserAndGetCredentials($name, $email, $password){
		$user = new User([
			'name' => $name,
			'email' => $email,
			'password' => \Hash::make($password),
			'status' => 2,
			'remember_token' => csrf_token()
			]);
		$user->save();
		return ['id' => $user->id, 'token' => $user->remember_token];
	}

	private function mailActivationToken($id, $email, $name, $token){
		Mail::send('emails.activation', ['id' => $id, 'token' => $token], function($message) use($email, $name){
			$message->from(env('PUBLIC_MAIL'), env('PUBLIC_MAIL_NAME'))
					->to($email, $name)
					->subject('[NO-REPLY] Código de activación www.lasfallasmasmolestas.esy.es');
		});
	}

	/**
		User login
	*/

	public function displayLogin(){
		return view('forms.login');
	}

	public function login(Request $request){
		$bannedActountMessage = 'Cuenta baneada. No puedes acceder por ahora';
		$notActivedAccountMessage = 'Cuenta sin activar. Comprueba tu bandeja de entrada. Debes de tener un correo con un enlace mediante el cual activarla';
		
		$nameOrEmail = $request->input('nameOrEmail');
		$password = $request->input('password');
		$userQuery = User::where('name', '=', $nameOrEmail)->orWhere('email', '=', $nameOrEmail);
		$userNotFound = !$userQuery->exists();
		$user = $userQuery->first();
		
		if($this->isNotValidData($nameOrEmail, $password))
			return view('forms.login')->with('errorMessage', 'Todos los campos son obligatorios');

		if($userNotFound)
			return view('forms.login')->with('errorMessage', 'No hay ningún usuario registrado con ese nombre o email');

		$isNotCorrectPassword = !(\Hash::check($password, $user->password));
		if($isNotCorrectPassword)
			return view('forms.login')->with('errorMessage', 'Combinación de usuario y contraseña inválidos');

		$accountNotActivated = $user->status != self::STATUS_ACTIVE;
		$userIsBanned = $user->status == self::STATUS_BANNED;
		if($accountNotActivated){
			if($userIsBanned)
				$message = $bannedActountMessage;
			else{
				$message = $notActivedAccountMessage;
				$this->mailActivationToken($user->id, $user->remember_token);
			}
			return view('forms.login')->with('errorMessage', $message);
		}

		$loginOK = \Auth::attempt(['id' => $user->id, 'password' => $password, 'status' => 1]);
		if($loginOK) 
			return redirect()->route('index')->with('successMessage', 'Has sido identificado correctamente');
	}

	public function isNotValidData($nameOrEmail, $password){
		$validator = Validator::make(
			['user' => $nameOrEmail, 'pass' => $password],
			['user' => 'required', 'pass' => 'required']
		);
		return $validator->fails();
	}

	/**
		USER LOGOUT
	*/

	public function logout(){
		$message = 'Sesión cerrada satisfactoriamente';

		\Auth::logout();
		return redirect()->route('index')->with('successMessage', $message);
	}

	/**
		USER ACTIVATION
	*/

	public function activate($id, $token){
		$validator = Validator::make(
			['id' => $id, 
			'token' => $token],
			['id' => 'required|numeric|exists:users,id', 
			'token' => 'required|exists:users,remember_token']
		);
		if($validator->fails())
			return redirect()->route('index')->with('errorMessage', 'Activación fallida. Datos incorrectos');

		$user = User::find($id);
		$user->status = 1;
		$user->save();

		return view('forms.login')
				->with('successMessage', 'Cuenta activada satisfactoriamente. Ya puedes entrar en tu cuenta');
	}

}