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


Route::controller('account', 'UserController');

Route::controller('admin', 'AdminController');

Route::controller('manage', 'ManageController');

Route::controller('err', 'ErrorController');

Route::controller('organisation', 'OrganisationController');

Route::get('reset', function(){
	Session::flush();
});

Route::get('/', 'HomeController@getIndex');
