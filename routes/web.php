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

    //Programs
    Route::get('admin/program/add',[
        'as' => 'programAdd',
        'uses' => 'ProgramController@programAdd'
    ]);
    Route::post('admin/program/save',[
        'as' => 'programSave',
        'uses' => 'ProgramController@programSave'
    ]);
    Route::get('admin/programs/list',[
        'as' => 'programsList',
        'uses' => 'ProgramController@programsList'
    ]);
    Route::get('admin/program/edit/{program}',[
        'as' => 'programEdit',
        'uses' => 'ProgramController@programsEdit'
    ]);
    Route::post('admin/program/update/{program}',[
        'as' => 'programUpdate',
        'uses' => 'ProgramController@programUpdate'
    ]);
    Route::get('admin/program/delete/{program}',[
        'as' => 'programDelete',
        'uses' => 'ProgramController@programDelete'
    ]);

    //Subjects
    Route::get('admin/subject/add',[
        'as'   => 'subjectAdd',
        'uses' => 'SubjectController@subjectAdd'
    ]);
    Route::get('admin/subjects/list',[
        'as' => 'subjectsList',
        'uses' => 'SubjectController@subjectsList'
    ]);
    Route::post('admin/subject/save',[
        'as' => 'subjectSave',
        'uses' => 'SubjectController@subjectSave'
    ]);
    Route::get('admin/subject/edit/{subject}',[
        'as' => 'subjectEdit',
        'uses' => 'SubjectController@subjectsEdit'
    ]);
    Route::post('admin/subject/update/{subject}',[
        'as' => 'subjectUpdate',
        'uses' => 'SubjectController@subjectUpdate'
    ]);
    Route::get('admin/subject/delete/{subject}',[
        'as' => 'subjectDelete',
        'uses' => 'SubjectController@subjectDelete'
    ]);

    //Tutors
    Route::get('admin/tutor/add',[
        'as'   => 'tutorAdd',
        'uses' => 'TutorController@tutorAdd'
    ]);

    Route::post('admin/tutor/add',[
        'as'   => 'tutorSave',
        'uses' => 'TutorController@tutorSave'
    ]);

    Route::get('admin/tutors/list',[
        'as' => 'tutorsList',
        'uses' => 'AdminController@tutorsList'
    ]);


    //Students
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