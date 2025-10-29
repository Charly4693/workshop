<?php

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
