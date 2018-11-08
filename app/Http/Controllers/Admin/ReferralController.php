<?php

namespace App\Http\Controllers\Admin;

use App\Models\InvestorReferralFields;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReferralController extends Controller
{
    public function index()
    {
        return view('admin.referral');
    }

    public function get()
    {
        return InvestorReferralFields::with('investor')->get();
    }

    public function update(Request $request)
    {
        $referral = InvestorReferralFields::where('id', $request->id)->first();
        $referral->send = 'true';
        $referral->save();

        return [
            'status' => true
        ];
    }
}
