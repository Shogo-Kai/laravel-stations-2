<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PracticeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\UserMovieController;

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

// Route::get('URL', [Controllerの名前::class, 'Controller内のfunction名']);


Route::get('/practice', [PracticeController::class, 'sample']);
Route::get('/practice2', [PracticeController::class, 'sample2']);
Route::get('/practice3', [PracticeController::class, 'sample3']);
Route::get('/getPractice', [PracticeController::class, 'getPractice']);

//映画一覧のページ
Route::get('/movies', [MovieController::class, 'index']);

//映画作品詳細ページ
Route::get('/movies/{id}', [MovieController::class, 'schedules']);

Route::get('/admin/schedules', [ScheduleController::class, 'adminSchedules']);

//管理者諸々
//管理画面
Route::get('/admin/movies/', [MovieController::class, 'adminMovies']);
//管理画面(登録)
Route::get('/admin/movies/create', [MovieController::class, 'create']);
//登録画面
Route::post('/admin/movies/store', [MovieController::class, 'store']);
//管理画面(編集)
Route::get('/admin/movies/{id}/edit/', [MovieController::class, 'edit']);
//更新処理
Route::patch('/admin/movies/{id}/update', [MovieController::class, 'update']);
//削除処理
Route::delete('/admin/movies/{id}/destroy', [MovieController::class, 'destroy']);

//座席表
Route::get('/sheets', [UserMovieController::class, 'sheets']);

