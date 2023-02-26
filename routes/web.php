<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
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
    Route::get('permission', [PermissionController::class, 'index']);

    Route::get('role', [RoleController::class, 'index'])->name('admin.role.index');
    Route::post('role/create', [RoleController::class, 'store'])->name('admin.role.store');
    Route::get('role/edit/{id}', [RoleController::class, 'edit'])->name('admin.role.edit');
    Route::put('role/update/{id}', [RoleController::class, 'update'])->name('admin.role.update');
    Route::delete('role/destroy/{id}', [RoleController::class, 'destroy'])->name('admin.role.destroy');
});
