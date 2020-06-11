<?php

use App\Http\Controllers\TodoController;
use App\Http\Controllers\TodoTasksController;
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

Route::get('/', 'TodoController@index')->name('home');
Route::post('/todos', 'TodoController@store');
Route::get('/todos/create', 'TodoController@create')->name('create');
Route::get('/todos/{todo}/edit', 'TodoController@edit')->name('todos.edit');
Route::put('/todos/{todo}', 'TodoController@update')->name('todos.update');
Route::get('/todos/{todo}', 'TodoController@show')->name('todos.show');
Route::delete('/todos/{todo}', 'TodoController@destroy');
Route::put('task/{task}', 'TodoTasksController@update');

