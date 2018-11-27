<?php

namespace App\Http\Controllers\Auth;

use App\Models\Investor;
use App\Models\InvestorHistoryFields;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
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
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|min:7|max:255|unique:investors',
            'password' => 'required|string|min:8|max:255|strong_password|confirmed',
            'g-recaptcha-response' => (env('APP_ENV') != 'local') ? 'required' : 'nullable'
        ]);
    }

    protected function reg_history_make($user)
    {
        InvestorHistoryFields::create([
            'investor_id' => $user->id,
            'action' => 'registration',
            'info_1' => $user->email,
            'info_2' => $user->password,
            'date' => Carbon::now()
        ]);
    }

    protected function create(array $data)
    {
        $referred_by = Investor::where('token', Cookie::get('referral'))->first();

        $user = Investor::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'referred_by' => $referred_by->id ?? null
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
        $user->save();

        $this->discordHook($user, $request);

        try {
            $this->guard()->login($user);
            $this->reg_history_make($user);
        } catch (\Exception $e) {
            Log::info('Something went wrong while register this user.');
        }

        return response()->json(['success_register' => 'good']);
    }

    protected function guard()
    {
        return Auth::guard();
    }

    protected function discordHook($user, Request $request)
    {
        date_default_timezone_set('Europe/Moscow');

        $send_obg = [
            'user_id' => '**investor_id: **' . $user['id'],
            'email' => '**email: **' . $user['email'],
            'name' => '**name: **' . $user['name'],
            'type_of_entrance' => '**type of entrance: **regular registration' ,
            'ip' => '**ip: **' . $_SERVER['REMOTE_ADDR'],
            'user_agent' => '**user_agent: **' . $request->header('User-Agent'),
            '**-----------------------------------------------------------------------------------------------------------**',
        ];

        if (env('APP_ENV') !== 'local') {
            $str = implode("\n", $send_obg);
            $client = new Client();
            try {
                $client->request('POST', 'https://discordapp.com/api/webhooks/515508451594731542/_tRHVIzca4N_6g4lHBieI-y8kEDousLefmGK-zXvwVVHUQUQHBckWwtEz0qmuFWuF4yf', [
                    'json' => [
                        'content' => $str,
                    ]
                ]);
            } catch (GuzzleException $e) {

            }
        }
    }
}
