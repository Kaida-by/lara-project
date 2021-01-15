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
Route::get('topic/edit/{id}', 'TopicController@edit')->name('topic.edit');
Route::patch('topic/show/{id}', 'TopicController@update')->name('topic.update');
Route::delete('topic/{id}', 'TopicController@destroy')->name('topic.destroy');

Route::get('test/index/{id}', 'TestController@index')->name('test.index');
Route::get('test/create/{id}', 'TestController@create')->name('test.create');
Route::post('test/show/{id}', 'TestController@store')->name('test.store');
Route::get('test/edit/{id}', 'TestController@edit')->name('test.edit');
Route::patch('test/showOne/{id}', 'TestController@update')->name('test.update');
Route::delete('test/{id}', 'TestController@destroy')->name('test.destroy');

Route::get('test/showAll/{id}', 'TestController@showAll')->name('test.showAll');
Route::patch('test/show/{id}', 'TestController@processingResponses')->name('test.prores');

Route::get('admin/', 'AdminController@index')->name('admin.index');
Route::get('admin/edit/', 'AdminController@edit')->name('admin.edit');
Route::patch('admin/', 'AdminController@update')->name('admin.update');
Route::get('admin/showCourses/', 'AdminController@showCourses')->name('admin.showCourses');
Route::get('admin/showPerformance/', 'AdminController@showPerformance')->name('admin.showPerformance');
Route::get('admin/calendar/', 'EventController@index')->name('admin.calendar');





Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
