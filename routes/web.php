<?php

use App\Http\Controllers\Model3DController;
use App\Models\Model3D;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

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

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('/model', Model3DController::class)->name('*','model');
});

//Temporal route for testing
Route::get('/test', function () {
    return view('test');
});

Route::post('/test', function (Request $request) {
    $file = $request->file('file');

    $chunkPath = Storage::disk('public')->path("chunks//{$file->getClientOriginalName()}"); //original

    // $chunkPath = public_path("chunks/{$file->getClientOriginalName()}");


    File::append($chunkPath, $file->get());

    if ($request->has('is_last') && $request->boolean('is_last')) {
        $name = basename($chunkPath, '.part');
        $destinyPath = Storage::disk('public')->path("models3D//$name"); //original

        File::move($chunkPath, $destinyPath); //original
    }

    return response()->json(['uploaded' => true]);
});

