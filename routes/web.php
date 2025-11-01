<?php

use App\Http\Controllers\HrManageController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {

    Route::get('/users/role', [RoleController::class, 'index'])->name('users.role');
    // Route::get('/users/role/check', [RoleController::class, 'check_role'])->name('users.role.check');
    Route::post('/users/role/store', [RoleController::class, 'storeRole'])->name('users.role.store');
    // Delete User Role
    Route::delete('/users/roles/{id}', [RoleController::class, 'destroy'])->name('users.role.destroy');
    // Permission
    Route::get('/users/permission', [RoleController::class, 'permission'])->name('users.permission');
    // Assign Role To Users
    Route::get('/users/select', [RoleController::class, 'users'])->name('users.index');
    Route::get('/users/{user}/roles', [RoleController::class, 'roles']);
    Route::post('/users/{user}/roles', [RoleController::class, 'updateRole']);
    // Assign Permission To Role
    Route::get('/roles', [RoleController::class, 'indexRole'])->name('roles.index');
    Route::get('/roles/{id}/permissions', [RoleController::class, 'permissions']);
    Route::post('/roles/{id}/permissions', [RoleController::class, 'updatePermissions']);
    // HR Managment
    Route::get('/create/designation', [HrManageController::class, 'createDesignation'])->name('create.designation');
    Route::post('/store/designation', [HrManageController::class, 'storeDesignation'])->name('store.designation');
    Route::get('/designation/list', [HrManageController::class, 'designationList'])->name('designation.list');
    Route::delete('/designation/{id}', [HrManageController::class, 'designationDelete'])->name('designation.delete');
    // Department Routes
    Route::get('/create/department', [HrManageController::class, 'createDepartment'])->name('create.department');
    Route::post('/store/department', [HrManageController::class, 'storeDepartment'])->name('store.department');
    Route::get('/department/list', [HrManageController::class, 'departmentList'])->name('department.list');
});

Route::resource('users', UsersController::class)->middleware('auth');


require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
