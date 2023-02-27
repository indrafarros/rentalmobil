<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
    return view('admin.layouts.main');
});

Route::group(['prefix' => 'admin'], function () {

    Route::group(['prefix' => 'permission'], function () {
        Route::get('/', [PermissionController::class, 'index'])->name('admin.permission.index');
        Route::post('create', [PermissionController::class, 'store'])->name('admin.permission.store');
        Route::get('edit/{id}', [PermissionController::class, 'edit'])->name('admin.permission.edit');
        Route::put('update/{id}', [PermissionController::class, 'update'])->name('admin.permission.update');
        Route::delete('destroy/{id}', [PermissionController::class, 'destroy'])->name('admin.permission.destroy');
    });

    Route::group(['prefix' => 'role'], function () {
        Route::get('/', [RoleController::class, 'index'])->name('admin.role.index');
        Route::post('create', [RoleController::class, 'store'])->name('admin.role.store');
        Route::get('edit/{id}', [RoleController::class, 'edit'])->name('admin.role.edit');
        Route::put('update/{id}', [RoleController::class, 'update'])->name('admin.role.update');
        Route::delete('destroy/{id}', [RoleController::class, 'destroy'])->name('admin.role.destroy');
    });

    Route::group(['prefix' => 'user'], function () {
        Route::get('/', [UserController::class, 'index'])->name('admin.user.index');
        Route::post('create', [UserController::class, 'store'])->name('admin.user.store');
    });
});
