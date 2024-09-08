<?php
namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Mail\OTPMail;
use App\Helper\JWTToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    function DashboardPage(){
        return view('pages.dashboard.dashboard-page');
    }

    function UserRegistrationPage(){
        return view('pages.auth.registration-page');
    }

    function UserLoginPage(){
        return view('pages.auth.login-page');
    }

    function ResetPasswordPage(){
        return view('pages.auth.reset-pass-page');
    }

    function SendOTPPage(){
        return view('pages.auth.send-otp-page');
    }

    function VerifyOTPPage(){
        return view('pages.auth.verify-otp-page');
    }

    function UserProfilePage(){
        return view('pages.dashboard.profile-page');
    }

    function UserRegistration(Request $request){
        
        try{
            User::create($request->input());
        
            return response()->json([
                'status' => 'success',
                'message' => 'Registration success'
            ]);
        } catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Registration failed'
            ]);
        }
        
        
    }

    function UserLogin(Request $request){
        $userCount = User::where('email', '=', $request->email)->where('password', '=', $request->password)->select('id')->first();

        if($userCount != null){
            $token = JWTToken::CreateToken($request->input('email'), $userCount->id);
            return response()->json([
                'status' => 'success',
                'message' => 'Login success',
            ])->cookie('token', $token, time()+60*5);
        } else{
            return response()->json([
                'status' => 'failed',
                'message' => 'Unauthorized',
            ]);
        }
    }

    function SendOTPCode(Request $request){
        $email = $request->input('email');
        $otp = rand(1000, 9999);
        $userCount = User::where('email', '=', $email)->count();

        if($userCount == 1){
            Mail::to($email)->send(new OTPMail($otp));
            User::where('email', '=', $email)->update(['otp' => $otp]);

            return response()->json([
                'status' => 'success',
                'message' => '4 digit otp code has been send to your mail',
            ]);
        } else{
            return response()->json([
                'status' => 'failed',
                'message' => 'Unauthorized',
            ]);
        }
    }

    function VerifyOTPCode(Request $request){
        $email = $request->input('email');
        $otp = $request->input('otp');

        $countUser = User::where('email', '=', $email)->where('otp', '=', $otp)->count();

        if($countUser == 1){
            User::where('email', '=', $email)->update(['otp' => '0']);
            
            $token = JWTToken::CreateTokenForResetPassword($email);
            
            return response()->json([
                'status' => 'success',
                'message' => 'OTP Verification success',
            ])->cookie('token', $token, time()+60*5);
        } else{
            return response()->json([
                'status' => 'failed',
                'message' => 'Unauthorized',
            ]);
        }
    }

    function ResetPassword(Request $request){
        try{
            $email = $request->header('email');
            $password = $request->input('password');
            User::where('email', '=', $email)->update(['password' => $password]);

            return response()->json([
                'status' => 'success',
                'message' => 'Password reset success',
            ]);
        } catch(Exception $exception){
            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong',
            ]);
        }

    }

    function userLogout(){
        return redirect('/userLogin')->cookie('token', '', -1);
    }

    function UserProfile(Request $request){
        $email = $request->header('email');
        $user = User::where('email', '=', $email)->first();
        return response()->json([
            'status' => 'success',
            'message' => 'Request success',
            'data' => $user
        ]);
    }

    function UpdateProfile(Request $request){
        try{
            $email = $request->header('email');

            User::where('email', '=', $email)->update([
                'firstName' => $request->input('firstName'),
                'lastName' => $request->input('lastName'),
                'mobile' => $request->input('mobile'),
                'password' => $request->input('password'),
            ]);
        
            return response()->json([
                'status' => 'success',
                'message' => 'Profile update success'
            ]);
        } catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Request failed'.$e->getMessage()
            ]);
        }
    }

}
