<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::group(['prefix' => 'api/v1'], function()
{
    Route::resource('authenticate', 'AuthenticateController', ['only' => ['index']]);
    Route::post('authenticate', 'AuthenticateController@authenticate');
    Route::get('authenticate/user', 'AuthenticateController@getAuthenticatedUser');
});

Route::group(['prefix' => 'api', 'middleware'=>['api', 'jwt.auth']], function(){
	// Route::resource('jokes', 'JokesController');
	Route::resource('customerterm', 'CustomerTermController');
	Route::resource('customer', 'CustomerController');
	Route::resource('vehiclediscountotr', 'DiscountOtrVehicleController');
	

	Route::get('presaleupload', 'ImageUploadController@index');
	Route::get('presaleupload/{id}', ['as' => 'getentry', 'uses' => 'ImageUploadController@show']);
	Route::post('presaleupload',[ 'as' => 'addentry', 'uses' => 'ImageUploadController@add']);



	Route::resource('presale', 'SaleController');
	Route::resource('type', 'TypeController');
	Route::resource('vehicle', 'VehiclesController');
});


// Route::resource('customer', 'CustomerController');
// Route::resource('customerterm', 'CustomerTermController');
// Route::resource('customer', 'CustomerController');
// Route::resource('discountotw', 'DiscountOtrController');
// Route::resource('imageupload', 'ImageUploadController');
// Route::resource('sale', 'SaleController');
// Route::resource('type', 'TypeController');