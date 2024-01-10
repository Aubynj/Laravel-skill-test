<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProjectController;

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

Route::get('/', function () {
    if (Auth::user()) {
        return redirect()->route('tasks.index');
    }
    return redirect()->route('login');
})->name('auth-home');

Route::post('/tasks/set-priority', [TaskController::class,'setPriority'])->name('tasks.setPriority');
    
Route::resource('tasks', TaskController::class)->parameters(['tasks' => 'id'])->middleware('auth');

Route::resource('projects', ProjectController::class)->parameters(['projects' => 'id'])->middleware('auth');

