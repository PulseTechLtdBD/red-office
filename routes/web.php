<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\OrganizationController;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

//Area APIS
Route::resource('areas', AreaController::class);

//Organization APIS
Route::resource('organizations', OrganizationController::class);


//User APIS
Route::resource('users', UserController::class);
Route::resource('users/profiles', UserProfileController::class);

//Department APIS
Route::resource('departments', DepartmentController::class);
// Route::post('/depts/{id}/assign/org/{id}', [DepartmentController::class, 'assignOrganization']);

//Designation APIS
Route::resource('designations', DesignationController::class);
// Route::post('/desigs/{id}/assign/org/{id}', [DepartmentController::class, 'assignDepartment']);

//Address APIS
Route::resource('addresses', AddressController::class);

//Role APIS
Route::resource('roles', RoleController::class);

//Permission APIs
Route::resource('permissions', PermissionController::class);
});
