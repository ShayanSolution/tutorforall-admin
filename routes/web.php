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

//Route::post('zukerbend/authenticate','AdminController@authenticate');

//Guest Middleware starts
Route::group(['middleware' => 'guest'],function (){
    Route::get('/zukerbend',[
       'as' => 'login',
       'uses' => 'AuthController@login'
    ]);

    Route::post('authenticate',[
        'as' => 'authenticate',
        'uses' => 'AuthController@authenticate'
    ]);

    Route::post('password/email',[
        'as' => 'password.email',
        'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail'
    ]);

    Route::get('password/reset',[
        'as' => 'password.request',
        'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm'
    ]);

    Route::post('password/update',[
        'as' => 'password.update',
        'uses' => 'Auth\ResetPasswordController@reset'
    ]);

    Route::get('password/reset/{token}',[
        'as' => 'password.reset',
        'uses' => 'Auth\ResetPasswordController@showResetForm'
    ]);
});
//Guests Middleware ends
//admin Middleware starts
Route::prefix('zukerbend')->group(function () {
//Route::group(['middleware' => 'admin'],function (){

    Route::get('documents/{id}',[
        'as' => 'download',
        'uses' => 'DocumentsController@downloadDoc'
    ]);

    Route::get('dashboard',[
        'as' => 'dashboard',
        'uses' => 'AdminController@dashboard'
    ]);

    Route::get('updatePasswordPage',[
        'as' => 'updatePasswordPage',
        'uses' => 'AdminController@updatePasswordPage'
    ]);

    //Programs
    Route::get('program/add',[
        'as' => 'programAdd',
        'uses' => 'ProgramController@programAdd'
    ]);
    Route::post('program/save',[
        'as' => 'programSave',
        'uses' => 'ProgramController@programSave'
    ]);
    Route::get('programs/list',[
        'as' => 'programsList',
        'uses' => 'ProgramController@programsList'
    ]);
    Route::get('program/edit/{program}',[
        'as' => 'programEdit',
        'uses' => 'ProgramController@programsEdit'
    ]);
    Route::post('program/update/{program}',[
        'as' => 'programUpdate',
        'uses' => 'ProgramController@programUpdate'
    ]);
    Route::get('program/delete/{program}',[
        'as' => 'programDelete',
        'uses' => 'ProgramController@programDelete'
    ]);

    //Subjects
    Route::get('subject/add',[
        'as'   => 'subjectAdd',
        'uses' => 'SubjectController@subjectAdd'
    ]);
    Route::get('subjects/list',[
        'as' => 'subjectsList',
        'uses' => 'SubjectController@subjectsList'
    ]);
    Route::post('subject/save',[
        'as' => 'subjectSave',
        'uses' => 'SubjectController@subjectSave'
    ]);
    Route::get('subject/edit/{subject}',[
        'as' => 'subjectEdit',
        'uses' => 'SubjectController@subjectsEdit'
    ]);
    Route::post('subject/update/{subject}',[
        'as' => 'subjectUpdate',
        'uses' => 'SubjectController@subjectUpdate'
    ]);
    Route::get('subject/delete/{subject}',[
        'as' => 'subjectDelete',
        'uses' => 'SubjectController@subjectDelete'
    ]);


    //Categories
    Route::get('category/add',[
        'as' => 'categoryAdd',
        'uses' => 'CategoryController@categoryAdd'
    ]);
    Route::post('category/save',[
        'as' => 'categorySave',
        'uses' => 'CategoryController@categorySave'
    ]);
    Route::get('categories/list',[
        'as' => 'categoriesList',
        'uses' => 'CategoryController@categoriesList'
    ]);
    Route::get('changeCategoryStatus',[
        'as' => 'changeCategoryStatus',
        'uses' => 'CategoryController@changeCategoryStatus'
    ]);
    Route::get('category/edit/{category}',[
        'as' => 'categoryEdit',
        'uses' => 'CategoryController@categoriesEdit'
    ]);
    Route::post('category/update/{category}',[
        'as' => 'categoryUpdate',
        'uses' => 'CategoryController@categoryUpdate'
    ]);
    Route::get('category/delete/{category}',[
        'as' => 'categoryDelete',
        'uses' => 'CategoryController@categoryDelete'
    ]);
    //Tutors
    Route::get('tutor/add',[
        'as'   => 'tutorAdd',
        'uses' => 'TutorController@tutorAdd'
    ]);

    Route::post('tutor/add',[
        'as'   => 'tutorSave',
        'uses' => 'TutorController@tutorSave'
    ]);
    Route::get('tutor/edit/{user}',[
        'as' => 'tutorEdit',
        'uses' => 'TutorController@tutorsEdit'
    ]);
    Route::post('tutor/update/{user}',[
        'as' => 'tutorUpdate',
        'uses' => 'TutorController@tutorUpdate'
    ]);
    Route::get('tutors/list',[
        'as' => 'tutorsList',
        'uses' => 'TutorController@tutorsList'
    ]);
    Route::get('tutors/disbursements',[
        'as' => 'tutorsDisbursements',
        'uses' => 'TutorController@tutorsDisbursementList'
    ]);
	Route::get('tutors/revenue',[
		'as' => 'tutorsRevenue',
		'uses' => 'TutorController@tutorsRevenueReports'
	]);
    Route::get('tutors/archivelist',[
        'as' => 'tutorsArchiveList',
        'uses' => 'TutorController@tutorsArchiveList'
    ]);
    Route::get('tutors/mentors',[
        'as' => 'mentorsList',
        'uses' => 'TutorController@mentorsList'
    ]);
    Route::post('tutors/filter',[
        'as' => 'tutorsFilter',
        'uses' => 'TutorController@applyTutorFilter'
    ]);
    Route::post('tutors/fetchProvince',[
        'as' => 'tutorsFilterProvince',
        'uses' => 'TutorController@fetchProvince'
    ]);

    Route::post('tutors/fetchArea',[
        'as' => 'tutorsFilterArea',
        'uses' => 'TutorController@fetchArea'
    ]);

    Route::post('tutors/fetchCity',[
        'as' => 'tutorsFilterCity',
        'uses' => 'TutorController@fetchCity'
    ]);

    Route::post('tutors/fetchSubjects',[
        'as' => 'tutorsFilterSubjects',
        'uses' => 'TutorController@fetchSubjects'
    ]);

    Route::get('candidate/{id}/documents',[
        'as' => 'candidateDocuments',
        'uses' => 'AdminController@candidateDocuments'
    ]);
    Route::get('documents/{id}/accept',[
        'as' => 'acceptDocument',
        'uses' => 'AdminController@acceptDocument'
    ]);
    Route::post('documents/reject',[
        'as' => 'rejectDocument',
        'uses' => 'AdminController@rejectDocument'
    ]);
    Route::get('candidates',[
        'as' => 'candidates',
        'uses' => 'AdminController@candidates'
    ]);
    Route::get('getSubjects/{id}',[
        'as' => 'getSubjects',
        'uses' => 'TutorController@getSubjects'
    ]);
    Route::post('tutor/subjects',[
        'as'   => 'tutorSubjectsUpdate',
        'uses' => 'TutorController@tutorSubjectsUpdate'
    ]);
    Route::post('tutor/profile',[
        'as'   => 'tutorProfileUpdate',
        'uses' => 'TutorController@profileUpdate'
    ]);
    Route::get('changeTutorStatus',[
        'as' => 'changeTutorStatus',
        'uses' => 'TutorController@changeTutorStatus'
    ]);
    Route::get('changeTutorApprovedStatus',[
        'as' => 'changeTutorApprovedStatus',
        'uses' => 'TutorController@changeTutorApprovedStatus'
    ]);
    Route::get('tutorProfile/{user}',[
        'as' => 'tutorProfile',
        'uses' => 'TutorController@tutorProfile'
    ]);
    Route::get('studentProfile/{user}',[
        'as' => 'studentProfile',
        'uses' => 'StudentController@studentProfile'
    ]);
    Route::get('tutor/delete/{tutor}',[
        'as' => 'tutorDelete',
        'uses' => 'TutorController@tutorDelete'
    ]);
    Route::get('tutor/restore/{tutor}',[
        'as' => 'tutorRestore',
        'uses' => 'TutorController@tutorRestore'
    ]);

    //Students
    Route::get('students/list',[
        'as' => 'studentsList',
        'uses' => 'StudentController@studentsList'
    ]);
    Route::get('students/deserving',[
        'as' => 'deservingStudentsList',
        'uses' => 'StudentController@deservingStudentsList'
    ]);
    Route::post('changeStudentDeserving',[
        'as' => 'changeStudentDeserving',
        'uses' => 'StudentController@changeStudentDeserving'
    ]);
    Route::post('changeStudentStatus',[
        'as' => 'changeStudentStatus',
        'uses' => 'StudentController@changeStudentStatus'
    ]);
    Route::get('student/delete/{student}',[
        'as' => 'studentDelete',
        'uses' => 'StudentController@studentDelete'
    ]);

    Route::get('tutors/coordinates',[
        'as' => 'coordinatesOfTutors',
        'uses' => 'TutorController@getCoordinatesOfTutors'
    ]);

    Route::get('logout',[
        'as' => 'logout',
        'uses' => 'AuthController@logout'
    ]);

    Route::post('documents/master-reject',[
        'as' => 'masterReject',
        'uses' => 'AdminController@masterReject'
    ]);

//    Route::prefix('zukerbend')->group(function () {
        Route::resource('percentage-costs', 'PercentageCostForMultiStudentGroupsController');
        Route::get('settings', 'SettingsController@getSettings')->name('getSettings');
        Route::post('settings/save', 'SettingsController@saveSettings')->name('saveSettings');
        Route::get('reports', 'ReportsController@tutorReportList')->name('reports');

        Route::get('session/booked', 'SessionController@sessionLogs')->name('sessionBooked');
        Route::get('session/started', 'SessionController@sessionLogs')->name('sessionStarted');
        Route::get('session/completed', 'SessionController@sessionCompleted')->name('sessionCompleted');
        Route::get('session/missed', 'SessionController@sessionLogs')->name('sessionMissed');
        Route::get('session/pending', 'SessionController@sessionLogs')->name('sessionPending');
        Route::get('session/rejected', 'SessionController@sessionLogs')->name('sessionRejected');
        Route::get('session/cancelled/tutor', 'SessionController@sessionCancelled')->name('sessionCancelledTutor');
        Route::get('session/cancelled/student', 'SessionController@sessionCancelled')->name('sessionCancelledStudent');

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

//    });

    Route::post('session/fetchProvince',[
        'as' => 'sessionFetchProvince',
        'uses' => 'SessionController@fetchProvince'
    ]);
    Route::post('session/fetchCity',[
        'as' => 'sessionFetchCity',
        'uses' => 'SessionController@fetchCity'
    ]);
    Route::post('session/fetchArea',[
        'as' => 'sessionFetchArea',
        'uses' => 'SessionController@fetchArea'
    ]);

});
//admin Middleware ends
