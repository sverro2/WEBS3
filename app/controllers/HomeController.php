<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function __construct() {
		parent::__construct();
	}
	/*
	public function getIndex()
	{
		$data['events'] = AirsoftEvent::all();
		return View::make('home', $data);
	}
	*/
	public function getIndex()
	{
		$data['events'] = AirsoftEvent::whereRaw('end > NOW()')->orderBy('start','asc')->take(8)->get();
		$data['ytURL'] = Settings::find('ytURL');
		return View::make('home', $data);
	}

	public function getEvents()
	{
		$first = Input::get('first');
		$count = Input::get('count');
		$data['events'] = AirsoftEvent::whereRaw('end > NOW()')->orderBy('start','asc')->skip($first)->take($count)->get();
		return View::make('organisation.event.elements.eventlist', $data);		
	}
}
