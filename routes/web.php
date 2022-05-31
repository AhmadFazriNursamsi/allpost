<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ApisController;


Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware'=>'auth'], function(){
   Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
   Route::get('/users', [UsersController::class, 'index'])->name('users');
   Route::get('/users/create', [UsersController::class, 'create']);
   Route::get('/users/edit/{id}', [UsersController::class, 'edit']);
   Route::post('/users/store', [UsersController::class, 'store']);
   Route::post('/users/update/{id}', [UsersController::class, 'update']);
   Route::post('/users/delete/{id}', [ApisController::class, 'apideleteuserbyid']);


   Route::get('/api/users/getdata', [ApisController::class, 'apigetdatauser']);
   Route::get('/api/getdivision', [ApisController::class, 'apigetdivisi']);
   Route::get('/api/getrole', [ApisController::class, 'apigetrole']);
   
});

require __DIR__.'/auth.php';
