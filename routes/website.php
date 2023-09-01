<?php


use App\Http\Controllers\Web\Auth\WebAuthenticatedSessionController;
use App\Http\Controllers\Web\Auth\WebRegisteredUserController;
use App\Http\Controllers\Web\CaloriesCounterController;
use App\Http\Controllers\Web\CaloriesEquationsController;
use App\Http\Controllers\Web\CartController;
use App\Http\Controllers\Web\HealthyPlanController;
use App\Http\Controllers\Web\InboxController;
use App\Http\Controllers\Web\OrderController;
use App\Http\Controllers\Web\PageController;
use App\Http\Controllers\Web\ProductController;
use App\Http\Controllers\Web\WebHomeController;
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

    Route::get('/', function () {
        return redirect()->route('admin');
    })->name('web-home');

});

