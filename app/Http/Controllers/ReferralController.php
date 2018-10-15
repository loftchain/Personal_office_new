<?php

namespace App\Http\Controllers;

use App\Services\ReferralService;
use Illuminate\Http\Request;

class ReferralController extends Controller
{
    protected $referralService;

    public function __construct(ReferralService $referralService)
    {
        $this->referralService = $referralService;
    }

    public function index()
    {
        $referrals = $this->referralService->getReferralData();

        return view('home.referrals', [
            'referrals' => $referrals
        ]);
    }
}
