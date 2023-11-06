<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\AuthController;
use App\Http\Controllers\Dashboard\CustomerController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\InstallmentRequestController;
use App\Http\Controllers\Dashboard\InvoiceController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\LawsuitController;
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

        //lawsuits
        Route::resource('lawsuits', LawsuitController::class);



        //customers
        Route::post('customers/change/activation/{customer}', [CustomerController::class, 'changeActivation'])->name('customers.change.activation');
        Route::get('customers/change/is/late/{customer}', [CustomerController::class, 'addToLateCustomersList'])->name('customers.addToLateCustomersList');

        Route::get('customers/black-list', [CustomerController::class,'blackList'])->name('customers.black-list');
        Route::get('customers/late-list', [CustomerController::class,'lateList'])->name('customers.late-list');
        Route::get('customers/late-list/export', [CustomerController::class,'exportLateList'])->name('customers.late-list.export');
        Route::resource('customers', CustomerController::class);
        Route::post('customers/import', [CustomerController::class,'import'])->name('customers.import');
        Route::get('customers/filter/laws', [CustomerController::class,'lawsCustomers'])->name('customers.laws');
        Route::get('customers/export/law', [CustomerController::class,'exportCustomersLaw'])->name('customers.export.law');

        //installment_requests
        Route::post('installment_requests.change.id_received/{installmentRequest}', [InstallmentRequestController::class, 'changeIdReceived'])->name('installment_requests.change.id_received');
        Route::post('installment_requests.accept/{installmentRequest}', [InstallmentRequestController::class, 'accept'])->name('installment_requests.accept');
        Route::post('installment_requests.reject/{installmentRequest}', [InstallmentRequestController::class, 'reject'])->name('installment_requests.reject');
        Route::resource('installment_requests', InstallmentRequestController::class);

        //invoices
        Route::get('invoices/print/{paper}', [InvoiceController::class, 'print_insurance_paper'])->name('invoice.print');
        Route::get('invoices/customer', [InvoiceController::class, 'getInvoice'])->name('invoice.getInvoice');
        Route::get('invoices/installments/{id}', [InvoiceController::class, 'indexInstallments'])->name('invoices.installments');
        Route::post('invoices/chane/installment/date', [InvoiceController::class, 'changeInstallmentDate'])->name('invoices.installments.change.date');
        Route::post('invoices/chane/installment/add_notes', [InvoiceController::class, 'add_notes'])->name('invoices.installments.add.notes');
        Route::post('invoices/posting/installment', [InvoiceController::class, 'postingInstallment'])->name('invoices.posting.installments');
        Route::post('invoices/month/posting/installment', [InvoiceController::class, 'monthPostingInstallment'])->name('invoices.month.posting.installments');
        Route::post('invoices/month/excuse', [InvoiceController::class, 'monthExcuse'])->name('invoices.month.excuse');
        Route::post('invoices/installment/pay', [InvoiceController::class, 'pay'])->name('invoices.installments.pay');
        Route::post('invoices/finish', [InvoiceController::class, 'finish'])->name('invoices.finish');
        Route::post('invoices/execution', [InvoiceController::class, 'execution'])->name('invoices.execution');
        Route::get('get_month_division/{month_count}/{installment_amount}', [InvoiceController::class, 'getMonthDivision'])->name('invoices.get_month_division');
        Route::post('invoices/finish_cash', [InvoiceController::class, 'finishCash'])->name('invoices.finish_cash');

        Route::resource('invoices', InvoiceController::class)->except('edit','update','destroy');




        Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
        Route::get('/export/monthInstallments', [HomeController::class, 'exportMonthInstallments'])->name('home.export.monthInstallments');
        Route::get('/export/lateInstallments', [HomeController::class, 'exportLateInstallments'])->name('home.export.lateInstallments');
        Route::get('/update_profile', [AuthController::class, 'index'])->name('update_profile');
        Route::post('/update_profile', [AuthController::class, 'update'])->name('update_profile_post');


        // admins Route
        Route::group(['prefix' => 'admins'], function () {
            $permission = 'admins';
            $controller = AdminController::class;

            Route::get('/', [$controller, 'index'])->name($permission)->middleware('permission:read-' . $permission);
            Route::get('/history/{id}', [$controller, 'history'])->name($permission.'.history');
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

