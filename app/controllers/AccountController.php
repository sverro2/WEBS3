<?php

class AccountController extends BaseController {

	private $pepper = "TgRNPFr00Z";

	public function __construct() {
		$this->beforeFilter('csrf', array('only' => 'postLogin'));
		$this->beforeFilter('csrf', array('only' => 'postRegister'));
	}

	public function getIndex()
	{
		$data['events'] = AirsoftEvent::all();
		return View::make('home', $data);
	}

	public function postLogin()
	{
		$name = Input::get('username');
		$pass = Input::get('password');

		$peppered = sha1(sha1($pass) . sha1($this->pepper));
		$user = User::where('username', '=', $name)->firstOrFail();

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
		}
		return Redirect::to('/');
	}

	public function getRegister()
	{
		return View::make('register');
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

	public function getLogout(){
		Session::forget('user');
		return Redirect::to('/');
	}
}
