<?php

use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PositionController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */
Route::get('/', function () {return redirect()->route('admin.home');});

Route::group(['middleware' => 'auth', 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/', [ProfileController::class, 'dashboard'])->name('home');
    Route::get('/profile/{user}', [ProfileController::class, 'profile'])->name('profile');
    Route::post('/profile/upload', [ProfileController::class, 'profileUpload']);
    Route::post('/password-change', [ProfileController::class, 'passwordChange']);

    //permission
    Route::get('/permission-datatable', [PermissionController::class, 'dataTable']);
    Route::resource('permissions', PermissionController::class);

    //roles
    Route::get('/roles-datatable', [RolesController::class, 'dataTable']);
    Route::resource('roles', RolesController::class);

    //users Or employee
    Route::get('/users-datatable', [UserController::class, 'dataTable']);
    Route::resource('users', UserController::class);

    //positions
    Route::get('/positions-datatable', [PositionController::class, 'dataTable']);
    Route::resource('positions', PositionController::class);

    //department
    Route::get('/departments-datatable', [DepartmentController::class, 'dataTable']);
    Route::resource('departments', DepartmentController::class);
});

require __DIR__ . '/auth.php';
