<?php

class UserController extends BaseController {

	private $pepper = "TgRNPFr00Z";

	public function __construct() {
		parent::__construct();
		$this->beforeFilter('csrf', array('only' => array('postLogin', 'postRegister')));
	}

	public function getIndex()
	{
		$data['events'] = AirsoftEvent::all();
		return View::make('home', $data);
	}

	public function getLogin()
	{
		return View::make('account.login');
	}

	public function postLogin()
	{
		$name = Input::get('username');
		$pass = Input::get('password');

		$peppered = sha1(sha1($pass) . sha1($this->pepper));
		try{
			$user = User::where('username', '=', $name)->firstOrFail();
		}catch(Exception $e){
			return Redirect::to('account/login');
		}
		/*
		//moet nog worden gefixed. Werkt nu nog niet omdat onze has anders is dan door Auth::atempt wordt verwacht...
		if (Auth::attempt(array('username'=>Input::get('username'), 'password'=>Input::get('password')))){
			return "yup";
		}else{
			return "no";
		}
		*/
		if($user === null)
		{
			return Redirect::to('account/login');
		}
		$salt = $user->salt;

		$salted = sha1($peppered . sha1($salt));

		/*
		var_dump('pass' . $pass . '<br/>');
		var_dump('pepper' . sha1($this->pepper) . '<br/>');
		var_dump('peppered' . $peppered . '<br/>');
		var_dump('salt' . $salt . '<br/>');
		var_dump('salted' . $salted . '<br/>');
		var_dump('userpass' . $user->password . '<br/>');
		*/
		if($salted === $user->password)
		{
			Session::put('user', $user);
		}else{
			return Redirect::to('account/login');
		}
		return Redirect::to('/');
	}
	
  
	protected function isPostRequest()
	{
	return Input::server("REQUEST_METHOD") == "POST";
	}

	protected function getLoginValidator()
	{
	return Validator::make(Input::all(), [
	  "username" => "required",
	  "password" => "required"
	]);
	}

	public function getRegister()
	{
		return View::make('account.register');
	}

	public function postRegister()
	{
		$name = Input::get('username');
		$pass = Input::get('password');
		$pass2 = Input::get('passwordconfirm');
		$user = new User;
		if(!($pass === $pass2)){
			return Redirect::to('account/register');
		}

		$user->username = $name;
		$salt = sha1(uniqid(mt_rand(), true));

		$peppered = sha1(sha1($pass) . sha1($this->pepper));

		$salted = sha1($peppered . sha1($salt));

		$user->password = $salted;
		$user->salt = $salt;

		$user->save();
		return Redirect::to('/');
	}

	protected function getRegisterValidator()
	{
	return Validator::make(Input::all(), [
	  "username" => "required",
	  "password" => "required"
	]);
	}

	public function getLogout(){
		Session::forget('user');
		return Redirect::to('/');
	}
}
