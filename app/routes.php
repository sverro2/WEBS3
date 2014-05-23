<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/* PRACTICE ROUTES
Route::get('/', array(
	'before'=>'birthday:08/05,hoi wereld',
	function()
	{
	//return View::make('hello');
    return 'In soviet Russia, function defines you.';
	}
));

Route::get('/test/{squirrel?}', function($squirrel = null)
{
	if($squirrel == null) return Redirect::to('/');
	$data['squirrel'] = $squirrel;
	return View::make('simple', $data);
});

route::controller('/', 'HomeController');

Route::get('/current/url', function()
{
    return URL::current();
});

Route::get('/', function()
{
	$data['events'] = AirsoftEvent::all();
    return View::make('home', $data);
});
*/

//Route::get('/', 'HomeController@getIndex');

Route::get('/', 'HomeController@getIndex');

Route::controller('account', 'AccountController');

Route::controller('admin', 'AdminController');

Route::get('reset', function(){
	Session::flush();
});