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
		$user = User::where('username', '=', 'admin')->firstOrFail();

		$salt = $user->salt;

		$salted = sha1($peppered . sha1($salt));

		if($salted == $user->password)
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
		$user = new User;

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
