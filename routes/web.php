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
    Route::get('/',[
       'as' => 'login',
       'uses' => 'AuthController@login'
    ]);

    Route::post('admin/authenticate',[
        'as' => 'authenticate',
        'uses' => 'AuthController@authenticate'
    ]);

    Route::post('admin/password/email',[
        'as' => 'password.email',
        'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail'
    ]);

    Route::get('admin/password/reset',[
        'as' => 'password.request',
        'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm'
    ]);

    Route::post('admin/password/update',[
        'as' => 'password.update',
        'uses' => 'Auth\ResetPasswordController@reset'
    ]);

    Route::get('admin/password/reset/{token}',[
        'as' => 'password.reset',
        'uses' => 'Auth\ResetPasswordController@showResetForm'
    ]);
});
//Guests Middleware ends
//admin Middleware starts
Route::group(['middleware' => 'admin'],function (){

    Route::get('admin/documents/{path}',[
        'as' => 'download',
        'uses' => 'DocumentsController@downloadDoc'
    ]);

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


    //Categories
    Route::get('admin/category/add',[
        'as' => 'categoryAdd',
        'uses' => 'CategoryController@categoryAdd'
    ]);
    Route::post('admin/category/save',[
        'as' => 'categorySave',
        'uses' => 'CategoryController@categorySave'
    ]);
    Route::get('admin/categories/list',[
        'as' => 'categoriesList',
        'uses' => 'CategoryController@categoriesList'
    ]);
    Route::get('admin/changeCategoryStatus',[
        'as' => 'changeCategoryStatus',
        'uses' => 'CategoryController@changeCategoryStatus'
    ]);
    Route::get('admin/category/edit/{category}',[
        'as' => 'categoryEdit',
        'uses' => 'CategoryController@categoriesEdit'
    ]);
    Route::post('admin/category/update/{category}',[
        'as' => 'categoryUpdate',
        'uses' => 'CategoryController@categoryUpdate'
    ]);
    Route::get('admin/category/delete/{category}',[
        'as' => 'categoryDelete',
        'uses' => 'CategoryController@categoryDelete'
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
    Route::get('admin/tutor/edit/{user}',[
        'as' => 'tutorEdit',
        'uses' => 'TutorController@tutorsEdit'
    ]);
    Route::post('admin/tutor/update/{user}',[
        'as' => 'tutorUpdate',
        'uses' => 'TutorController@tutorUpdate'
    ]);
    Route::get('admin/tutors/list',[
        'as' => 'tutorsList',
        'uses' => 'TutorController@tutorsList'
    ]);
    Route::get('admin/tutors/mentors',[
        'as' => 'mentorsList',
        'uses' => 'TutorController@mentorsList'
    ]);
    Route::get('admin/candidate/{id}/documents',[
        'as' => 'candidateDocuments',
        'uses' => 'AdminController@candidateDocuments'
    ]);
    Route::get('admin/documents/{id}/accept',[
        'as' => 'acceptDocument',
        'uses' => 'AdminController@acceptDocument'
    ]);
    Route::post('admin/documents/reject',[
        'as' => 'rejectDocument',
        'uses' => 'AdminController@rejectDocument'
    ]);
    Route::get('admin/candidates',[
        'as' => 'candidates',
        'uses' => 'AdminController@candidates'
    ]);
    Route::get('admin/getSubjects/{id}',[
        'as' => 'getSubjects',
        'uses' => 'TutorController@getSubjects'
    ]);
    Route::post('admin/tutor/subjects',[
        'as'   => 'tutorSubjectsUpdate',
        'uses' => 'TutorController@tutorSubjectsUpdate'
    ]);
    Route::get('admin/changeTutorStatus',[
        'as' => 'changeTutorStatus',
        'uses' => 'TutorController@changeTutorStatus'
    ]);
    Route::get('admin/tutorProfile/{user}',[
        'as' => 'tutorProfile',
        'uses' => 'TutorController@tutorProfile'
    ]);
    Route::get('admin/tutor/delete/{tutor}',[
        'as' => 'tutorDelete',
        'uses' => 'TutorController@tutorDelete'
    ]);

    //Students
    Route::get('admin/students/list',[
        'as' => 'studentsList',
        'uses' => 'AdminController@studentsList'
    ]);
    Route::get('admin/students/deserving',[
        'as' => 'deservingStudentsList',
        'uses' => 'AdminController@deservingStudentsList'
    ]);
    Route::post('admin/changeStudentDeserving',[
        'as' => 'changeStudentDeserving',
        'uses' => 'AdminController@changeStudentDeserving'
    ]);
    Route::post('admin/changeStudentStatus',[
        'as' => 'changeStudentStatus',
        'uses' => 'AdminController@changeStudentStatus'
    ]);
    Route::get('admin/student/delete/{student}',[
        'as' => 'studentDelete',
        'uses' => 'AdminController@studentDelete'
    ]);

    Route::get('admin/logout',[
        'as' => 'logout',
        'uses' => 'AuthController@logout'
    ]);
});
//admin Middleware ends