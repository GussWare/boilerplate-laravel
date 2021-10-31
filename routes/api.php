<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\JwtMiddleware;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix("/v1")->group(function() {
    Route::prefix("/auth")->group(function(){
        Route::post('/login', [AuthController::class, "login"]);
        Route::post('/logout', [AuthController::class, "logout"]);
        Route::post('/register', [AuthController::class, "register"]);
    });

    Route::prefix("/users")->group(function(){
        Route::middleware("jwt:users_paginate")->get('/', [UserController::class, "getPaginate"]);
        Route::middleware("jwt:users_all")->get('/all', [UserController::class, "getAll"]);
        Route::middleware("jwt:users_get_by_id")->get('/{id}', [UserController::class, "getById"]);
        Route::middleware("jwt:users_get_by_email")->get('/by-email/{email}', [UserController::class, "getByEmail"]);
        Route::middleware("jwt:users_create")->post('/', [UserController::class, "create"]);
        Route::middleware("jwt:users_update")->put('/{id}', [UserController::class, "update"]);
        Route::middleware("jwt:users_delete")->put('/{id}', [UserController::class, "delete"]);
    });

    Route::prefix("/roles")->group(function(){
        Route::middleware("jwt:roles_paginate")->get('/', [RolesController::class, "getPaginate"]);
        Route::middleware("jwt:roles_all")->get('/all', [RolesController::class, "getAll"]);
        Route::middleware("jwt:roles_get_by_id")->get('/{id}', [RolesController::class, "getAll"]);
        Route::middleware("jwt:roles_create")->post('/', [RolesController::class, "create"]);
        Route::middleware("jwt:roles_update")->put('/{id}', [RolesController::class, "update"]);
        Route::middleware("jwt:roles_delete")->delete('/{id}', [RolesController::class, "delete"]);
    });
});

