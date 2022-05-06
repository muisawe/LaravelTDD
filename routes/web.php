<?php

use App\Http\Controllers\ProjectsController;
use App\Models\Project;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum'])->group(function () {

    Route::post('/projects', [ProjectsController::class, 'store'])->name('projects.store');
    Route::get('projects', [ProjectsController::class, 'index']);
    Route::get('projects/create', [ProjectsController::class, 'create']);
    Route::get('projects/{project}', [ProjectsController::class, 'show']);
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
