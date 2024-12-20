<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

echo ("inside web.php from bootstrap.php --->");

// Route::get('/', function () {
//     return view('welcome');
// });


Route::resource('users', UserController::class);
