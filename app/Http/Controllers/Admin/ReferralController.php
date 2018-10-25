<?php

namespace App\Http\Controllers\Admin;

use App\Models\InvestorReferralFields;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReferralController extends Controller
{
    public function index()
    {
        $referrals = InvestorReferralFields::with('investor')->get();

        return view('admin.referral', [
            'referrals' => $referrals
        ]);
    }

    public function update(Request $request)
    {
        $referral = InvestorReferralFields::where('id', $request->id)->first();
        $referral->send = 'true';
        $referral->save();

        return [
            'status' => 'ok'
        ];
    }
}
