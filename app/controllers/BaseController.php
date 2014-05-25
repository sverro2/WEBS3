<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */

	public function __construct(){
		$user = null;
		if(Session::has('user'))
		{
			$user = Session::get('user');
			$data['user'] = $user;
		}
		View::share('user', $user);
	}

	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}
