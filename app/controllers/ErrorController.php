<?php

class ErrorController extends BaseController {

	public function __construct() {
		parent::__construct();
	}

	public function getIndex()
	{
		return Redirect::to('/');
	}

	public function getPageNotFound()
	{
		return View::make('error.404');
	}

}
