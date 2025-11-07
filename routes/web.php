<?php

use App\Http\Controllers\DeliveryNoteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SparePartController;
use App\Http\Controllers\FactoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;






/*Route::get('/', function () {
    return view('inicio');
});*/

Auth::routes([
    'register' => false
]);


Route::get('/', function () {
    $error = session()->get('error');
    if (Auth::check()) {
        return redirect()->route('companies.index')->with('error', $error);
    }
    Log::info($error);

    return redirect('/login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resource('/factories', FactoryController::class);
Route::resource('/deliverynotes', SparePartController::class);
Route::resource('/spareparts', DeliveryNoteController::class);

