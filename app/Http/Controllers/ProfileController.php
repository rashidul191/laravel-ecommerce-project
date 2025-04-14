<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Models\CustomerProfile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // Create User Profile
    public function CreateProfile(Request $request)
    {

        $user_id = $request->header('id');
        $request->merge(['user_id' => $user_id]);
        $data = CustomerProfile::updateOrCreate(
            ['user_id' => $user_id],
            $request->input()
        );
        return ResponseHelper::Out('success', $data, 200);
    }


    // Get User Profile

    public function ReadProfile(Request $request)
    {
        $user_id = $request->header('id');
        $data = CustomerProfile::where('user_id', '=', $user_id)->first();
        return ResponseHelper::Out('success', $data, 200);
    }
}
