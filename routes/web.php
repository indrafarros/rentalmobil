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
    Route::get('role', [RoleController::class, 'index'])->name('admin.role');
});
