<?php

namespace App\Http\Controllers;

use App\Models\BusinessSetting;
use Illuminate\Http\Request;

class BusinessSettingController extends Controller
{
    //

    public function BusinessSettingCreate(Request $request)
    {
        // dd($request);

        $key = $request->key;
        $value = $request->value;

        // dd($key, $value);

        $createBusinessSetting = BusinessSetting::updateOrCreate(
            ["key" => $key],
            ["key" => $key, "value" => $value]
        );

        return $createBusinessSetting;
    }

    // public function BusinessSettingShow(){

    // }
}
