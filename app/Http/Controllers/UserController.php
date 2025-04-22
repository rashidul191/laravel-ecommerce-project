<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Helper\ResponseHelper;
use App\Mail\OTPMail;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function UserLoginPage()
    {
        return view('pages.user-login');
    }
    // User Create and Send OPT email
    public function UserLogin(Request $request)
    {
        try {
            $UserEmail = $request->UserEmail;
            $OTP = rand(100000, 999999);
            $MailBodyDetails = ['code' => $OTP];

            Mail::to($UserEmail)->send(new OTPMail($MailBodyDetails));

            User::updateOrCreate(
                ['email' => $UserEmail],
                ['email' => $UserEmail, 'otp' => $OTP],
            );
            return ResponseHelper::Out('success', 'A 6 Digit OTP has been send to  you email address', 200);
        } catch (Exception $e) {
            return ResponseHelper::Out('fail', $e, 200);
        }
    }

    // Verify User using OTP
    public function VerifyLogin(Request $request)
    {
        $UserEmail = $request->UserEmail;
        $OTP = $request->OTP;

        $verification = User::where('email', $UserEmail)->where('otp', $OTP)->first();


        // dd($verification);
        if ($verification) {
            User::where('email', $UserEmail)->where('otp', $OTP)->update(
                ['otp' => 0]
            );
            $token = JWTToken::CreateToken($UserEmail, $verification->id);
            return ResponseHelper::Out('success', '', 200)->cookie('token', $token, 60 * 24 * 60);
        } else {
            return ResponseHelper::Out('fail', null, 401);
        }
    }
    // User Login To Admin page
    public function UserLoginToAdmin(Request $request)
    {
        $UserEmail = $request->input('email');
        $userGet = User::where('email', $UserEmail)->first();
        // dd($userGet);
        if ($userGet) {
            $token = JWTToken::CreateToken($UserEmail, $userGet->id);
            // ResponseHelper::Out('success', '', 200)->cookie('token', $token, 60 * 24 * 60);
            // dd($addTokenToCookie);
            return redirect()
            ->route('admin.index')
            ->with('success', 'User Login Successfully !')
            ->cookie('token', $token, 60 * 24 * 60); // 60 days
        } else {
            return ResponseHelper::Out('fail', null, 401);
        }
    }


    // User Logout
    public function Logout()
    {
        return redirect('/userLogin')->cookie('token', '', -1);
    }
}
