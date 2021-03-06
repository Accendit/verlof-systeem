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
    return redirect('/absences');
});

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('absences', 'AbsenceController');

Route::post('/absences/{absence}/approve', 'AbsenceController@approve')->name('absences.approve');

Route::post('/absences/{absence}/disapprove', 'AbsenceController@disapprove')->name('absences.disapprove');