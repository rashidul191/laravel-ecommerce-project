<?php

use App\Models\BusinessSetting;

if (!function_exists("business_setting")) {
    function business_setting($key, $default = null)
    {
        return BusinessSetting::where('key', $key)->value('value') ?? $default;
    }
}
