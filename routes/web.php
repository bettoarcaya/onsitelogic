<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});



Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function(){
    Route::get('participants', 'ParticipantController@index')->name('participants');
    
});

Route::group(['prefix' => 'participants', 'middleware' => 'auth'], function () {
    Route::get('/', 'ParticipantController@getParticipants');
    Route::get('/{id}', 'ParticipantController@show');
    Route::post('/', 'ParticipantController@store');
    Route::get('/types', 'ParticipantController@participantTypes');
});

Auth::routes();
