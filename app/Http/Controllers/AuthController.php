<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | SEND OTP
    |--------------------------------------------------------------------------
    */

    public function sendOtp(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'mobile' => [
                'required',
                'digits:10',
                'regex:/^[6-9][0-9]{9}$/',
            ],
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => false,
                'message' => 'Please enter a valid mobile number.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $mobile = $request->mobile;

        $otp = rand(100000, 999999);

        $user = User::where('mobile', $mobile)->first();

        if ($user) {

            $user->update([
                'otp' => $otp,
            ]);
        } else {
            // Generate random username
            $randomName = 'User' . rand(1000, 9999);

            // Make sure username is unique
            while (User::where('name', $randomName)->exists()) {
                $randomName = 'User' . rand(1000, 9999);
            }

            $user = User::create([
                'name' => $randomName,
                'mobile' => $mobile,
                'otp' => $otp,
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'OTP sent successfully.',
            'mobile' => $mobile,

            // Remove this in production
            'dev_otp' => $otp,
        ]);
    }

    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => [
                'required',
                'digits:10',
                'regex:/^[6-9][0-9]{9}$/',
            ],

            'otp' => [
                'required',
                'digits:6',
            ],
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => false,
                'message' => 'Invalid mobile number or OTP.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $mobile = $request->mobile;
        $otp = $request->otp;


        $user = User::where('mobile', $mobile)->first();

        if (!$user) {

            return response()->json([
                'status' => false,
                'message' => 'Mobile number not found. Please request OTP again.',
            ], 404);
        }


        if ($user->otp !== $otp) {

            return response()->json([
                'status' => false,
                'message' => 'Invalid OTP. Please try again.',
            ], 422);
        }

        Auth::login($user, true);

        return response()->json([
            'status' => true,
            'message' => 'Login successful.',
            'redirect' => route('home'),

            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'mobile' => $user->mobile,
            ],
        ]);
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
