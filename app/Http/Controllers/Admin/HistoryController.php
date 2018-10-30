<?php

namespace App\Http\Controllers\Admin;

use App\Models\InvestorHistoryFields;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HistoryController extends Controller
{
    public function index()
    {
        return view('admin.history');
    }

    public function get()
    {
        $histories = InvestorHistoryFields::with('investor')->get();

        $histories = $histories->toArray();
        $data = [];

        foreach ($histories as $history){
            $data[$history['investor']['id']] = [];
            foreach ($history as $key => $action){
                if($key === 'reg_email'){
                    if($action){
                        $data[$history['investor']['id']]['reg'][] = $history['reg_email'];
                        $data[$history['investor']['id']]['reg'][] = $history['reg_pwd'];
                        $data[$history['investor']['id']]['reg'][] = $history['reg_at'];
                    }
                }
                if($key === 'change_email_new'){
                    if($action){
                        $data[$history['investor']['id']]['change_email'][] = $history['change_email_new'];
                        $data[$history['investor']['id']]['change_email'][] = $history['change_email_old'];
                        $data[$history['investor']['id']]['change_email'][] = $history['change_email_at'];
                    }
                }
                if($key === 'change_pwd_new'){
                    if($action){
                        $data[$history['investor']['id']]['change_pwd'][] = $history['change_pwd_new'];
                        $data[$history['investor']['id']]['change_pwd'][] = $history['change_pwd_old'];
                        $data[$history['investor']['id']]['change_pwd'][] = $history['change_pwd_at'];
                    }
                }
                if($key === 'forgot_pwd_new'){
                    if($action){
                        $data[$history['investor']['id']]['forgot_pwd'][] = $history['forgot_pwd_new'];
                        $data[$history['investor']['id']]['forgot_pwd'][] = $history['forgot_pwd_old'];
                        $data[$history['investor']['id']]['forgot_pwd'][] = $history['forgot_pwd_at'];
                    }
                }
            }
        }

        return $data;
    }
}
