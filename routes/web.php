<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\todoController;
use App\Http\Controllers\userController;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

//コントローラーのルーティング設定
//localhost:8080/todo/list_ルーティング設定_＠～はコントローラー内の変数名
Route::get('/todo/list', 'App\Http\Controllers\todoController@todolist')->name('todo.list');

//削除機能
Route::post('delete{id}', [todoController::class, 'delete'])->name('todo.delete');

//検索機能
Route::get('search', [todoController::class, 'search'])->name('todo.search');

//詳細ページ
Route::post('/todo/list/detailslist/{id}', [todoController::class, 'details'])->name('details.list');

//1.入力ページ
Route::get('/todo/list/newlist', [todoController::class, 'newlist'])->name('new.list');

//2.確認ページ
Route::post('/todo/list/confirm/{id?}', [todoController::class, 'confirm'])->name('confirm.list');

//3.登録
Route::post('/todo/list/registcomp/{id?}', [todoController::class, 'add'])->name('registcomp');

//4.完了ページ
Route::get('/todo/list/success', [todoController::class, 'success']);

//編集ページ
Route::get('/todo/list/edit/{id}', [todoController::class, 'editing'])->name('edit.list');

//登録データなし
Route::get('/todo/list/nodeta', [todoController::class, 'nodeta'])->name('nodeta.list');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Auth::routes();

//ユーザー一覧
Route::get('/todo/user', [userController::class, 'userlist'])->name('user.list');

//検索機能
Route::get('usersearch', [userController::class, 'search'])->name('user.search');

//編集ページ
Route::get('/todo/user/edit/{id}', [userController::class, 'editing'])->name('edit.user');

//削除機能
Route::post('userdelete{id}', [userController::class, 'delete'])->name('user.delete');

//1.入力ページ
Route::get('/todo/user/newuser', [userController::class, 'newuser'])->name('new.user');

//2.確認ページ
Route::post('/todo/user/confirm/{id?}', [userController::class, 'confirm'])->name('confirm.user');

//3.登録
Route::post('/todo/user/registcomp/{id?}', [userController::class, 'add'])->name('registcomp.user');