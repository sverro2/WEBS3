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

route::controller('controllertest', 'HomeController');

Route::get('/current/url', function()
{
    return URL::current();
});
*/

Route::get('/', function()
{
    return View::make('home');
});