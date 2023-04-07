<?php

use App\Http\Resources\FileCollection;
use App\Http\Resources\FileResource;
use App\Models\File; 
use App\Models\Storage; 
use App\Http\Controllers\FileController;
use App\Http\Controllers\ProfileController; 
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use TCG\Voyager\Facades\Voyager;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/upload', function () {
    return Inertia::render('Upload');
})->middleware(['auth', 'verified'])->name('upload');

Route::get('/log', function () {
    return Inertia::render('Log');
})->middleware(['auth', 'verified'])->name('log');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
}); 

Route::post('file/upload', [FileController::class, 'uploadFile']); 
Route::post('folder/upload', [FileController::class, 'uploadFolder']); 
Route::post('file/download', [FileController::class, 'downloadFile']); 
Route::post('file/rename', [FileController::class, 'renameFile']); 
Route::post('file/delete', [FileController::class, 'deleteFile']);
Route::post('file/favourite', [FileController::class, 'deleteFile']);

Route::get('file/get', function () { 
    return FileResource::collection(File::where('storageId', Storage::where('userId', auth()->id())->first()->id)->get()); 
}); 



require __DIR__.'/auth.php'; 

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
