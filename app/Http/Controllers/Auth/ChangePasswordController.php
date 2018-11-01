<?php

namespace App\Http\Controllers\Auth;

use App\Models\Investor;
use App\Http\Controllers\Controller;
use App\Models\InvestorHistoryFields;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class ChangePasswordController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'old_password' => 'required|string|min:3|max:1024',
            'password' => 'required|string|min:3|max:1024|confirmed',

        ]);
    }

    protected function change_pwd_history_make($old_pwd, $new_pwd)
    {
        InvestorHistoryFields::create([
            'investor_id' => Auth::id(),
            'action' => 'change_pwd',
            'info_1' => bcrypt($old_pwd),
            'info_2' => bcrypt($new_pwd),
            'date' => Carbon::now()
        ]);
    }

    public function renew_password(Request $request)
    {
        $input = $request->all();
        $validator = $this->validator($input);
        $user = $request->user();
        $passwordIsVerified = password_verify($request->old_password, $user->password);

        if (strlen($user->password) < 15) {
            return redirect(route('logout'));
        }

        if ($validator->fails()) {
            return response()->json(['validation_error' => $validator->errors()]);
        }

        if (!$passwordIsVerified) {
            return response()->json(['pwd_not_match' => Lang::get('modals/modals.PwdNotMatch_ChangePasswordController')]);
        }

        if (trim(strtolower($input['old_password'])) == trim(strtolower($input['password']))) {
            return response()->json(['not_equal' => Lang::get('modals/modals.ShouldNotBeEqual_ChangePasswordController')]);
        }

        $request->user()->fill([
            'password' => bcrypt($request['password'])
        ])->save();

        $this->change_pwd_history_make($input['old_password'], $input['password']);

        return response()->json(['success_changed_pwd' => 'good']);
    }
}

