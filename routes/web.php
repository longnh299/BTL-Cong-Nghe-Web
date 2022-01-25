<?php

use App\Http\Controllers\SigninController;
use App\Http\Controllers\WorkspaceController;
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
Route::middleware('auth')->group(function()
{
    // Route::get('/',[WorkspaceController::class,'index'])->name('index');
    Route::redirect('/', '/boards')->name('index');
    Route::get('/boards', '\App\Http\Controllers\BoardsManagerController@index')->name('boards');
    Route::post('/boards', '\App\Http\Controllers\BoardsManagerController@create')->name('board.create');

    Route::post('/boards/search', '\App\Http\Controllers\BoardsManagerController@search')->name('board.search');

    Route::get('/boards/{board_id}', '\App\Http\Controllers\BoardsManagerController@edit')->name('board.edit');
    Route::put('/boards/{board_id}', '\App\Http\Controllers\BoardsManagerController@update')->name('board.update');
    Route::delete('/boards/{board_id}', '\App\Http\Controllers\BoardsManagerController@delete')->name('board.delete');

    Route::get('/workspace/board/{board_id}', '\App\Http\Controllers\WorkspaceController@index')->name('board.workspace');

    Route::get('/boards/{board_id}/invite', '\App\Http\Controllers\BoardsManagerController@invite')->name('board.invite');
    Route::post('/boards/{board_id}/invite', '\App\Http\Controllers\BoardsManagerController@inviteCreate')->name('board.inviteCreate');
    Route::delete('/boards/{board_id}/kick/{user_id}', '\App\Http\Controllers\BoardsManagerController@kick')->name('board.kick');

    Route::get('/boards/{board_id}/columns', '\App\Http\Controllers\BoardsManagerController@columns')->name('board.columns');
    Route::post('/boards/{board_id}/columns', '\App\Http\Controllers\BoardsManagerController@add')->name('board.add');

    Route::get('columns/{column_id}', '\App\Http\Controllers\ColumnsManagerController@edit')->name('column.edit');
    Route::put('columns/{column_id}', '\App\Http\Controllers\ColumnsManagerController@update')->name('column.update');
    Route::delete('columns/{column_id}', '\App\Http\Controllers\ColumnsManagerController@delete')->name('column.delete');
    Route::get('/columns/{column_id}/tasks', '\App\Http\Controllers\ColumnsManagerController@index')->name('column.tasks');
    Route::post('/columns/{column_id}/tasks', '\App\Http\Controllers\ColumnsManagerController@createTask')->name('column.createTask');

    Route::delete('/columns/{column_id}/tasks/{task_id}', '\App\Http\Controllers\ColumnsManagerController@deleteTask')->name('column.deleteTask');

    Route::get('/tasks/{task_id}', '\App\Http\Controllers\TasksManagerController@index')->name('task.index');
    Route::put('/tasks/{task_id}', '\App\Http\Controllers\TasksManagerController@update')->name('task.update');

    Route::post('/tasks/{task_id}', '\App\Http\Controllers\TasksManagerController@join')->name('task.join');
    Route::delete('/tasks/{task_id}', '\App\Http\Controllers\TasksManagerController@unjoin')->name('task.unjoin');

    Route::post('/tasks/{task_id}/comment', '\App\Http\Controllers\TasksManagerController@comment')->name('task.comment');
    Route::put('comments/{comment_id}', '\App\Http\Controllers\CommentManagerController@update')->name('comment.update');
    Route::delete('comments/{comment_id}', '\App\Http\Controllers\CommentManagerController@delete')->name('comment.delete');

});



Route::get('/signup', function () {
    return view('pages/signup');
})->name('signup');
Route::post('/signup','\App\Http\Controllers\Auth\SignupController@signUp')->name('signup');

Route::get('/signin',[SigninController::class,'signin'])->name('signin');
Route::post('/signin',[SigninController::class,'authenticate'])->name('signin.authenticate');
Route::get('/logout',[SigninController::class, 'logout'])->name('logout');
