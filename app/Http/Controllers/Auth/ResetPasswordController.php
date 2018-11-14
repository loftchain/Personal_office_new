<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Models\Investor;
use App\Models\InvestorHistoryFields;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

//    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showResetForm(Request $request, $token = null)
    {
        $investor = Investor::where('token',$token)->first();
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $investor->email]
        );
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'token' => 'required',
            'email' => 'required|string|email|min:7|max:255',
            'password' => 'required|confirmed|string|min:8|max:1024|strong_password',
            'g-recaptcha-response' => (env('APP_ENV') != 'local') ? 'required' : 'nullable'
        ]);
    }

    protected function forgot_history_make($id, $old_pwd, $new_pwd)
    {
        InvestorHistoryFields::create([
            'investor_id' => $id,
            'action' => 'forgot_pwd',
            'info_1' => $old_pwd,
            'info_2' => $new_pwd,
            'date' => Carbon::now()
        ]);
    }

    public function reset(Request $request)
    {
        $rightUser = Investor::where('token', $request['token'])->first();
        $user = Investor::where('email', $request['email'])->first();
        $input = $request->all();
        $validator = $this->validator($input);

        if ($validator->fails()) {
            return response()->json(['validation_error' => $validator->errors()]);
        }

        if ($request['email'] != $rightUser->email) {
            return response()->json(['reset_email_not_match' => __('auth/resetPwd.emailDontMatch_ResetPasswordsTrait')]);
        }

        if ($request['password'] != $request['password_confirmation']) {
            return response()->json(['not_equal' => __('auth/resetPwd.pwdNotEqual_ResetPasswordsTrait')]);
        }

        $old_password = $user->password;
        $user->password = Hash::make($request['password']);
        $user->token = Str::random(15);
        $user->reset_attempts += 1;
        $user->save();

        $request->session()->forget('user_token');
        $this->forgot_history_make($user['id'], $old_password, $user->password);
        event(new PasswordReset($user));
        $this->guard()->login($user);

        return response()->json(['success_reset_pwd' => 'success']);
    }

    protected function guard()
    {
        return Auth::guard();
    }
}
