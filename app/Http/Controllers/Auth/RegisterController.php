<?php

namespace App\Http\Controllers\Auth;

use App\Models\Investor;
use App\Models\InvestorHistoryFields;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|min:7|max:255|unique:investors',
            'password' => 'required|string|min:3|max:255|confirmed',
            'g-recaptcha-response' => 'required'
        ]);
    }

    protected function reg_history_make($user){
        InvestorHistoryFields::create([
            'investor_id' => $user->id,
            'reg_email' => $user->email,
            'reg_pwd' => $user->password,
            'reg_at' => Carbon::now()
        ]);
    }

    protected function create(array $data)
    {
        $referred_by = Investor::where('token', Cookie::get('referral'))->first();

        $user = Investor::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'referred_by'   => $referred_by->id ?? null
        ]);

        return $user;
    }

    protected function register(Request $request)
    {
        $input = $request->all();
        $validator = $this->validator($input);

        if ($validator->fails()) {
            return response()->json(['validation_error' => $validator->errors()]);
        }

        $data = $this->create($input)->toArray();
        $user = Investor::find($data['id']);
        $user->token = str_random(15);
        $user->ip_token = request()->ip();
        $user->remember_token = str_random(15);
        $user->reg_attempts += 1;
        $user->valid_step = 1;
        $user->save();

        try{
            $this->guard()->login($user);
            $this->reg_history_make($user);
        }
        catch(\Exception $e){
            Log::info('Something went wrong while register this user.');
        }

        return response()->json(['success_register' => 'good']);
    }

    protected function guard()
    {
        return Auth::guard();
    }

//    protected function validator(array $data)
//    {
//        return Validator::make($data, [
//            'name' => 'required|string|max:255',
//            'email' => 'required|string|email|max:255|unique:users',
//            'password' => 'required|string|min:6|confirmed',
//            'g-recaptcha-response' => 'required|captcha',
//        ]);
//    }
//
//    /**
//     * Create a new user instance after a valid registration.
//     *
//     * @param  array  $data
//     * @return \App\User
//     */
//    protected function create(array $data)
//    {
//        return User::create([
//            'name' => $data['name'],
//            'email' => $data['email'],
//            'password' => Hash::make($data['password']),
//            'token' => str_random(15),
//        ]);
//    }
}
