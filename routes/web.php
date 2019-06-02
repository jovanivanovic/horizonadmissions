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

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@home');

    Route::group(['middleware' => 'role:administrator', 'prefix' => 'admin', 'namespace' => 'Administration\\'], function () {
        Route::get('/users', "UsersController@index")->name('admin.users');
        Route::get('/users/create', "UsersController@create")->name('admin.users.create');
        Route::get('/users/{user}/edit', "UsersController@edit")->name('admin.users.edit');
        Route::get('/users/{user}/toggle_status', "UsersController@toggle_status")->name('admin.users.toggle_status');
        Route::post('/users', "UsersController@store")->name('admin.users.store');
        Route::put('/users/{user}', "UsersController@update")->name('admin.users.update');

        Route::get('/interviews', "InterviewsController@index")->name('admin.interviews');

        Route::get('/interview_types', "InterviewTypesController@index")->name('admin.interview_types');
        Route::get('/interview_types/create', "InterviewTypesController@create")->name('admin.interview_types.create');
        Route::get('/interview_types/{interview_type}', "InterviewTypesController@show")->name('admin.interview_types.show');
        Route::get('/interview_types/{interview_type}/edit', "InterviewTypesController@edit")->name('admin.interview_types.edit');
        Route::get('/interview_types/{interview_type}/delete', "InterviewTypesController@delete")->name('admin.interview_types.delete');

        Route::post('/interview_types', "InterviewTypesController@store")->name('admin.interview_types.store');
        Route::put('/interview_types/{interview_type}', "InterviewTypesController@update")->name('admin.interview_types.update');
        Route::delete('/interview_types/{interview_type}', "InterviewTypesController@destroy")->name('admin.interview_types.destroy');
    });

    Route::group(['middleware' => 'role:student', 'prefix' => 'student', 'namespace' => 'Students\\'], function () {
        Route::get('/interviews', "InterviewsController@index")->name('student.interviews');
        Route::get('/interviews/create', "InterviewsController@create")->name('student.interviews.create');
        Route::post('/interviews/store', "InterviewsController@store")->name('student.interviews.store');
    });

    Route::group(['middleware' => 'role:staff', 'prefix' => 'staff', 'namespace' => 'Staff\\'], function () {
        Route::get('/interviews', "InterviewsController@index")->name('staff.interviews');
        Route::get('/interviews/{interview}/confirm', "InterviewsController@confirm")->name('staff.interviews.confirm');
        Route::get('/interviews/{interview}/reject', "InterviewsController@reject")->name('staff.interviews.reject');
    });
});