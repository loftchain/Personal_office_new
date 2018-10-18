<?php

namespace App\Http\Controllers\Auth;

use App\Models\InvestorHistoryFields;
use App\Models\Investor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class ChangeEmailController extends Controller
{
    protected function validator(array $data)
    {
        //todo Проверить
        //'old_email' => 'required|string|email|min:7|max:255',
        //'password' => 'required|string|min:3|max:1024'
        if(Auth::user()->email && Auth::user()->password){
            return Validator::make($data, [
                'old_email' => 'string|email|min:7|max:255',
                'email' => 'required|string|email|min:7|max:255',
                'password' => 'string|min:3|max:1024'
            ]);
        }else{
            return Validator::make($data, [
                'email' => 'required|string|email|min:7|max:255',
            ]);
        }

    }

    protected function change_email_history_make($old_email, $new_email)
    {
        $chm = [
            'change_email_old' => $old_email,
            'change_email_new' => $new_email,
            'change_email_at' => Carbon::now(),
        ];

        if ($old_email && $new_email) {
            InvestorHistoryFields::where('investor_id', Auth::id())->update($chm);
        }
    }

    public function reset_email(Request $request)
    {
        $input = $request->all();
        $validator = $this->validator($input);
        $user = $request->user();
        $possible_user = Investor::where('email', $input['email'])->first();

        if(Auth::user()->password){
            $passwordIsVerified = password_verify($request['password'], $user->password);
        }

        if ($validator->fails()) {
            return response()->json(['validation_error' => $validator->errors()]);
        }

        if ($user->email != $input['old_email']) {
            return response()->json(['not_your_email' => Lang::get('modals/modals.NotYourEmail_ChangeEmailController')]);
        }

        if (trim(strtolower($input['old_email'])) == trim(strtolower($input['email']))) {
            return response()->json(['not_equal' => Lang::get('modals/modals.ShouldNotBeEqual_ChangeEmailController')]);

        }

        if($user->password){
            if (!Auth::user()->password && !$passwordIsVerified) {
                return response()->json(['pwd_not_match' => Lang::get('modals/modals.PwdNotMatch_ChangeEmailController')]);
            }
        }

        if (!$user || $possible_user) {
            return response()->json(['is_taken' => Lang::get('modals/modals.EmailIsTaken_ChangeEmailController')]);
        }

        $user->email = $input['email'];
        $user->save();

        $this->change_email_history_make($input['old_email'], $input['email']);

        return response()->json(['success_changed_email' => 'good']);

    }
}
