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

    Route::get('admin/documents/{id}',[
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
    Route::get('admin/tutors/disbursements',[
        'as' => 'tutorsDisbursements',
        'uses' => 'TutorController@tutorsDisbursementList'
    ]);
	Route::get('admin/tutors/revenue',[
		'as' => 'tutorsRevenue',
		'uses' => 'TutorController@tutorsRevenueReports'
	]);
    Route::get('admin/tutors/archivelist',[
        'as' => 'tutorsArchiveList',
        'uses' => 'TutorController@tutorsArchiveList'
    ]);
    Route::get('admin/tutors/mentors',[
        'as' => 'mentorsList',
        'uses' => 'TutorController@mentorsList'
    ]);
    Route::post('admin/tutors/filter',[
        'as' => 'tutorsFilter',
        'uses' => 'TutorController@applyTutorFilter'
    ]);
    Route::post('admin/tutors/fetchProvince',[
        'as' => 'tutorsFilterProvince',
        'uses' => 'TutorController@fetchProvince'
    ]);

    Route::post('admin/tutors/fetchArea',[
        'as' => 'tutorsFilterArea',
        'uses' => 'TutorController@fetchArea'
    ]);

    Route::post('admin/tutors/fetchCity',[
        'as' => 'tutorsFilterCity',
        'uses' => 'TutorController@fetchCity'
    ]);

    Route::post('admin/tutors/fetchSubjects',[
        'as' => 'tutorsFilterSubjects',
        'uses' => 'TutorController@fetchSubjects'
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
    Route::post('admin/tutor/profile',[
        'as'   => 'tutorProfileUpdate',
        'uses' => 'TutorController@profileUpdate'
    ]);
    Route::get('admin/changeTutorStatus',[
        'as' => 'changeTutorStatus',
        'uses' => 'TutorController@changeTutorStatus'
    ]);
    Route::get('admin/changeTutorApprovedStatus',[
        'as' => 'changeTutorApprovedStatus',
        'uses' => 'TutorController@changeTutorApprovedStatus'
    ]);
    Route::get('admin/tutorProfile/{user}',[
        'as' => 'tutorProfile',
        'uses' => 'TutorController@tutorProfile'
    ]);
    Route::get('admin/tutor/delete/{tutor}',[
        'as' => 'tutorDelete',
        'uses' => 'TutorController@tutorDelete'
    ]);
    Route::get('admin/tutor/restore/{tutor}',[
        'as' => 'tutorRestore',
        'uses' => 'TutorController@tutorRestore'
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

    Route::get('admin/tutors/coordinates',[
        'as' => 'coordinatesOfTutors',
        'uses' => 'TutorController@getCoordinatesOfTutors'
    ]);

    Route::get('admin/logout',[
        'as' => 'logout',
        'uses' => 'AuthController@logout'
    ]);


    Route::prefix('admin')->group(function () {
        Route::resource('percentage-costs', 'PercentageCostForMultiStudentGroupsController');
        Route::get('settings', 'SettingsController@getSettings')->name('getSettings');
        Route::post('settings/save', 'SettingsController@saveSettings')->name('saveSettings');
        Route::get('session/booked', 'SessionController@sessionBooked')->name('sessionBooked');
        Route::get('reports', 'ReportsController@tutorReportList')->name('reports');
        Route::get('session/started', 'SessionController@sessionStarted')->name('sessionStarted');
        Route::get('session/completed', 'SessionController@sessionCompleted')->name('sessionCompleted');
        Route::get('session/missed', 'SessionController@sessionMissed')->name('sessionMissed');
        Route::get('session/pending', 'SessionController@sessionPending')->name('sessionPending');
        Route::get('session/rejected', 'SessionController@sessionRejected')->name('sessionRejected');
        Route::get('session/list', 'SessionController@sessionList')->name('sessionList');

        Route::resource('notifications', 'NotificationController');
        Route::post('download/document', 'DocumentsController@downloadDocument')->name('downloadDocument');

        Route::get('cms/tootar/tc', 'CMSController@getTootarTC')->name('getTootarTC');
        Route::post('cms/tootar/postTC', 'CMSController@postTootarTC')->name('postTootarTC');
        Route::get('cms/tootar-teacher/tc', 'CMSController@getTootarTeacherTC')->name('getTootarTeacherTC');
        Route::post('cms/tootar-teacher/postTC', 'CMSController@postTootarTeacherTC')->name('postTootarTeacherTC');
        Route::post('reset-term-condition', 'CMSController@resetTC')->name('resetTC');
        //Banner
        Route::resource('banners', 'BannerController');

    });

    Route::post('admin/session/fetchProvince',[
        'as' => 'sessionFetchProvince',
        'uses' => 'SessionController@fetchProvince'
    ]);
    Route::post('admin/session/fetchCity',[
        'as' => 'sessionFetchCity',
        'uses' => 'SessionController@fetchCity'
    ]);
    Route::post('admin/session/fetchArea',[
        'as' => 'sessionFetchArea',
        'uses' => 'SessionController@fetchArea'
    ]);

});
//admin Middleware ends
