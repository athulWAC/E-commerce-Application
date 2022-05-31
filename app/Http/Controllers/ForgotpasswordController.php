<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPasswordEmailMail;
use App\Models\PasswordReset as ModelsPasswordReset;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ForgotpasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function forgotPassword()
    {
        return view('forget-password.index');
    }



    /**
     * show password reset  form
     *
     * @return response()
     */
    public function showResetPasswordForm($token)
    {
        return view('forget-password.confirmpassword', ['token' => $token]);
    }



    // no
    public function forgotPasswordRequest(Request $request)
    {
        $email = $request->email;
        $randomId  =   rand(2, 50);
        Mail::to($email)->send(new ForgotPasswordEmailMail($email));
    }



    /**
     *  submit forgot password form
     *
     * @return response()
     */
    public function submitForgetPasswordForm(Request $request)
    {

        $request->validate([
            'email' => 'required|email|exists:users',
        ]);
        $token = \Str::random(64);
        // dd($token);


        ModelsPasswordReset::insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('mail.forgot-password-mail', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });


        return back()->with('message', 'We have e-mailed your password reset link!');
    }


    /**
     *  submit password reset form
     *
     * @return response()
     */
    public function submitResetPasswordForm(Request $request)
    {
        // dd($request);
        $request->validate([
            //   'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('password_resets')
            ->where([
                // 'email' => $request->email,
                'token' => $request->token
            ])
            ->first();
        if (!$updatePassword) {
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $user = User::where('email', $updatePassword->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email' => $request->email])->delete();

        return redirect('/')->with('message', 'Your password has been changed!');
    }
}
