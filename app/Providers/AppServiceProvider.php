<?php

namespace App\Providers;

use App\Models\InvoiceInstallments;
use App\Models\Setting;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Carbon;
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

        if (Schema::hasTable('settings')) {
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
        }
        if (Schema::hasTable('invoices')) {
            $installments = InvoiceInstallments::whereNotIn('status', [1, 7, 8, 9])->get();
            foreach ($installments as $row) {
//                $pay_date = Carbon::parse($row->pay_date);
//                $next_day = $pay_date->addDays(1);
                if ($row->pay_date < now()->format('Y-m-d')) {
                    if ($row->status != 3) {
                        //send notification
                        $message = 'على العميل / ' . $row->invoice->customer->name . ' في الفاتورة رقم: ' . $row->invoice->id . ' قسط رقم: ' . $row->id;
                        send_notification('قسط متأخر', $message, $row->invoice_id, 'invoices.installments');
                    }
                    $diff = now()->diffInDays($row->pay_date);
                    $row->status = 3;
                    $row->late_days = $diff;
                    $row->save();
                }
            }


            //collect_date
            $installments_collect_date = InvoiceInstallments::whereNull('collect_date')->get();
            foreach ($installments_collect_date as $row) {
                if ($row->monthly_installment == $row->paid_amount) {
                    $row->collect_date = Carbon::now();
                    $row->save();
                }
            }

        }
    }
}
