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

//Route::get('/', function () {
//    return view('welcome');
//});

//Route::get('admin/login','AuthController@login')->name('login');
//Route::post('admin/authenticate','AdminController@authenticate');

//Guest Middleware starts
Route::group(['middleware' => 'guest'],function (){
    Route::get('admin/login',[
       'as' => 'login',
       'uses' => 'AuthController@login'
    ]);

    Route::post('admin/authenticate',[
        'as' => 'authenticate',
        'uses' => 'AuthController@authenticate'
    ]);
});
//Guests Middleware ends
//admin Middleware starts
Route::group(['middleware' => 'admin'],function (){
    Route::get('admin/dashboard',[
        'as' => 'dashboard',
        'uses' => 'AdminController@dashboard'
    ]);

    Route::get('admin/updatePasswordPage',[
        'as' => 'updatePasswordPage',
        'uses' => 'AdminController@updatePasswordPage'
    ]);

    Route::get('admin/tutor/add',[
        'as'   => 'tutorAdd',
        'uses' => 'AdminController@tutorAdd'
    ]);

    Route::get('admin/tutors/list',[
        'as' => 'tutorsList',
        'uses' => 'AdminController@tutorsList'
    ]);
    Route::get('admin/students/list',[
        'as' => 'studentsList',
        'uses' => 'AdminController@studentsList'
    ]);
    Route::get('admin/changeStudentDeserving',[
        'as' => 'changeStudentDeserving',
        'uses' => 'AdminController@changeStudentDeserving'
    ]);

    Route::get('admin/logout',[
        'as' => 'logout',
        'uses' => 'AuthController@logout'
    ]);
});
//admin Middleware ends