<?php

use App\Http\Controllers\Admin\CheckinCheckoutController;
use App\Http\Controllers\Admin\CompanySettingController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PositionController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Laragear\WebAuthn\WebAuthn;

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
WebAuthn::routes();

Route::get('/', function () {return redirect()->route('admin.home');});

//checkin checkout
Route::get('/pin-code', [CheckinCheckoutController::class, 'index'])->name('pincode.index');
Route::post('/check-in', [CheckinCheckoutController::class, 'checkin']);

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

    //company
    Route::resource('company-settings', CompanySettingController::class)->only(['edit', 'update', 'show']);
    Route::post('/company-name/edit', [CompanySettingController::class, 'nameSave']);
    Route::post('/company-email/edit', [CompanySettingController::class, 'emailSave']);
    Route::post('/company-phone/edit', [CompanySettingController::class, 'phoneSave']);
    Route::post('/company-address/edit', [CompanySettingController::class, 'addressSave']);
    Route::post('/company-start-time/edit', [CompanySettingController::class, 'startTimeSave']);
    Route::post('/company-end-time/edit', [CompanySettingController::class, 'endTimeSave']);
    Route::post('/company-break-start-time/edit', [CompanySettingController::class, 'breakStartTimeSave']);
    Route::post('/company-break-end-time/edit', [CompanySettingController::class, 'breakEndTimeSave']);

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
