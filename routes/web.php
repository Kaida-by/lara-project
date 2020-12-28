<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', 'CourseController@index');
Route::get('course/', 'CourseController@index')->name('course.index');
Route::get('course/create', 'CourseController@create')->name('course.create');
Route::post('course/', 'CourseController@store')->name('course.store');
Route::get('course/show/{id}', 'CourseController@show')->name('course.show');
Route::get('course/edit/{id}', 'CourseController@edit')->name('course.edit');
Route::patch('course/show/{id}', 'CourseController@update')->name('course.update');
Route::delete('course/{id}', 'CourseController@destroy')->name('course.destroy');

Route::get('courses/record/{id}', 'CourseController@record')->name('course.record');
Route::post('course/show/{id}', 'CourseController@recordAct')->name('course.recordAct');

Route::get('topic/index/{id}', 'TopicController@index')->name('topic.index');
Route::get('topic/show/{id}', 'TopicController@show')->name('topic.show');
Route::get('topic/create/{id}', 'TopicController@create')->name('topic.create');
Route::post('topic/show/{id}', 'TopicController@store')->name('topic.store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
