<?php

class AdminController extends BaseController {

	public function __construct() {
		parent::__construct();
		//$this->beforeFilter('auth.admin');
	}

	public function getIndex()
	{
		return View::make('admin.home');
	}

	public function getBootstrap(){
		return View::make('admin.bootstrap');
	}

}
