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
    return view('times/index');
});
Route::get('/end', 'TimesController@endding');
Route::get('/end', 'TimesController@total');
Route::get('/tasks', 'TodosController@index');
Route::get('/tasks', 'TodosController@elapsedTime');
Route::post('/tasks', 'TodosController@achieve');
Route::post('/tasks', 'TodosController@store');
Route::delete('/tasks/{todo}', 'TodosController@destroy');
Route::get('/times/{todo}', 'TodosController@task_name');
// Route::get('/times/{todo}/study', 'TodosController@task_name2');
// Route::get('/times', 'TodosController@task_name');
Route::get('/times/{todo}/study', 'TimesController@dynamic');
Route::get('/times/{todo}', 'TimesController@staticc');
Route::post('/times/{todo}/study', 'TimesController@start');
Route::post('/times/{todo}', 'TimesController@stop');
// Route::post('/times/{todo}', 'TimesController@staticc');
// Route::post('/times{todo}', 'TimesController@store');
// Route::post('/times/{todo}/', 'TimesController@start');
