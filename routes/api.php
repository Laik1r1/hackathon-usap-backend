<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CrudUserController;

Route::middleware('auth:jwt')->group(function () {
    Route::post('/logout', [LoginController::class, 'Logout']);

    Route::middleware("createStudent")->group(function (){      
      Route::post('/register', [CrudUserController::class, 'RegisterStudent']);
    });

    Route::middleware("isAdmin")->group(function (){      
      Route::post('/registerProfessor', [CrudUserController::class, 'RegisterProfessor']);
    });
});

Route::post('/login', [LoginController::class, 'Login']);
