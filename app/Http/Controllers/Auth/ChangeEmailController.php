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
        if (Auth::user()->email && Auth::user()->password) {
            return Validator::make($data, [
                'old_email' => 'string|email|min:7|max:255',
                'email' => 'required|string|email|min:7|max:255',
                'password' => 'string|min:3|max:1024'
            ]);
        } else {
            return Validator::make($data, [
                'email' => 'required|string|email|min:7|max:255',
            ]);
        }

    }

    protected function change_email_history_make($old_email, $new_email)
    {
        InvestorHistoryFields::create([
            'investor_id' => Auth::id(),
            'action' => 'change_email',
            'info_1' => $old_email,
            'info_2' => $new_email,
            'date' => Carbon::now(),
        ]);
    }

    public function reset_email(Request $request)
    {
        $input = $request->all();
        $validator = $this->validator($input);
        $user = $request->user();
        $possible_user = Investor::where('email', $input['email'])->first();

        if (Auth::user()->password) {
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

        if ($user->password) {
            if (Auth::user()->password && !$passwordIsVerified) {
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

    public function set_email(Request $request)
    {
        $user = Auth::user();
        $isUser = Investor::where('email', $request->email)->first();
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return response()->json(['validation_error' => $validator->errors()]);
        }

        if ($isUser) {
            return response()->json(['is_taken' => Lang::get('modals/modals.EmailIsTaken_ChangeEmailController')]);
        }

        $user->email = $request->email;
        $user->save();

        $this->change_email_history_make($request->email, $request->email);

        return [
            'success_set_email' => true
        ];

    }
}
