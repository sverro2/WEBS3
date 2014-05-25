<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */

	public function __construct(){
		$user = null;
		$organisations = null;
		if(Session::has('user'))
		{
			$user = Session::get('user');
			$data['user'] = $user;
			if($user->isAdmin()){
				$organisations = Organisation::all();
			}
		}
		View::share('user', $user);
		View::share('organisations', $organisations);
	}

	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}
