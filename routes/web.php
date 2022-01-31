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

Route::get('/times', 'TimesController@index');
Route::get('/end', 'TimesController@endding');
Route::get('/tasks', 'TodosController@index');
Route::post('/tasks', 'TodosController@store');
Route::delete('/tasks/{todo}', 'TodosController@destroy');
Route::get('/', function () {
    return view('times/index');
});
// Route::get('/end', function () {
//     return view('times/end');
// });
// Route::get('/tasks', function () {
//     return view('tasks/index');
// });

