<?php

namespace App\Providers;

use App\Models\InvoiceInstallments;
use App\Models\Setting;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View as ViewComposer;
use Illuminate\Support\Facades\View;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        date_default_timezone_set('Africa/Cairo');
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();


        $globalSetting = Cache::get('settings');
        if (!$globalSetting) {
            $this->app->singleton('settings', function ($app) {
                return Cache::rememberForever('settings', function () {
                    return Setting::pluck('val', 'key');
                });
            });
            $globalSetting = $this->app->make('settings');
        }

        View::composer('*', function ($view) use ($globalSetting) {
            $view->with('globalSetting', $globalSetting);
        });

        if (Schema::hasTable('invoices')) {
            $installments = InvoiceInstallments::whereNotIn('status', [1, 7])->get();
            foreach ($installments as $row) {
                if ($row->pay_date < now()->format('Y-m-d')) {
                    $diff = now()->diffInDays($row->pay_date);
                    $row->status = 3;
                    $row->late_days = $diff;
                    $row->save();
                }

            }

        }

    }
}
