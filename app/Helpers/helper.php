<?php

    use App\Models\Setting;

//    if (!function_exists('settings')) {
//        function settings($key)
//        {
//            return Setting::where('key', $key)->first()->val;
//        }
//    }
    if (!function_exists('getLang')) {
        function getLang($model, $value)
        {
             if (app()->isLocale('en')) {
                return $model[$value . '_en'];
            } else {
                return $model[$value . '_ar'];
            }
        }
    }

    if (!function_exists('settings')) {
        function settings($key)
        {
            return Setting::where('key', $key)->first()->val;
        }
    }

    if (!function_exists('getFolder')) {
        function getFolder()
        {
            return app()->getLocale() == 'ar' ? 'rtl.css' : 'css';
        }
    }
    if (!function_exists('getWebFolder')) {
        function getWebFolder()
        {
            return app()->getLocale() == 'ar' ? 'rtl.min.css' : 'min.css';
        }
    }
