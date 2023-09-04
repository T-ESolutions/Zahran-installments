<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\AuthController;
use App\Http\Controllers\Dashboard\CustomerController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\InstallmentRequestController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\SettingController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {


    Route::get('/dashboard', [AuthenticatedSessionController::class, 'create'])->name('admin');
    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login');

    Route::group(['prefix' => 'admin', 'middleware' => 'auth:web'], function () {

        Route::post('customers.change.activation/{customer}', [CustomerController::class, 'changeActivation'])->name('customers.change.activation');
        Route::resource('customers', CustomerController::class);


        Route::post('installment_requests.change.id_received/{installmentRequest}', [InstallmentRequestController::class, 'changeIdReceived'])->name('installment_requests.change.id_received');
        Route::resource('installment_requests', InstallmentRequestController::class);


        Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
        Route::get('/update_profile', [AuthController::class, 'index'])->name('update_profile');
        Route::post('/update_profile', [AuthController::class, 'update'])->name('update_profile_post');


        // admins Route
        Route::group(['prefix' => 'admins'], function () {
            $permission = 'admins';
            $controller = AdminController::class;

            Route::get('/', [$controller, 'index'])->name($permission)->middleware('permission:read-' . $permission);
            Route::get('create', [$controller, 'create'])->name($permission . '.create')->middleware('permission:create-' . $permission);
            Route::post('store', [$controller, 'store'])->name($permission . '.store')->middleware('permission:create-' . $permission);
            Route::get('edit/{id}', [$controller, 'edit'])->name($permission . '.edit')->middleware('permission:update-' . $permission);
            Route::post('update/{id}', [$controller, 'update'])->name($permission . '.update')->middleware('permission:update-' . $permission);
            Route::get('delete/{id}', [$controller, 'delete'])->name($permission . '.delete')->middleware('permission:delete-' . $permission);
            Route::post('change-activation/{admin}', [$controller, 'changeActivation'])->name($permission . '.change.activation')->middleware('permission:delete-' . $permission);
        });
        // roles Route
        Route::group(['prefix' => 'roles'], function () {
            $permission = 'roles';
            $controller = RoleController::class;
            Route::get('/', [$controller, 'index'])->name($permission)->middleware('permission:read-' . $permission);
            Route::get('create', [$controller, 'create'])->name($permission . '.create')->middleware('permission:create-' . $permission);
            Route::post('store', [$controller, 'store'])->name($permission . '.store')->middleware('permission:create-' . $permission);
            Route::get('edit/{id}', [$controller, 'edit'])->name($permission . '.edit')->middleware('permission:update-' . $permission);
            Route::post('update/{id}', [$controller, 'update'])->name($permission . '.update')->middleware('permission:update-' . $permission);
            Route::get('delete/{id}', [$controller, 'delete'])->name($permission . '.delete')->middleware('permission:change-activation-' . $permission);
        });
        //settings
        Route::group(['prefix' => 'settings'], function () {
            Route::get('/', [SettingController::class, 'index'])->name('settings');
            Route::post('/update', [SettingController::class, 'update'])->name('settings.update');
        });

        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
            ->name('logout');
    });

});

