<?php

namespace App\Http\Controllers\Admin;

use App\Models\Investor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KycController extends Controller
{
    public function index()
    {
        $investors = Investor::has('personal')->with('personal')->paginate(10);

        return view('admin.kyc', [
            'investors' => $investors
        ]);
    }

    public function confirm(Investor $investor)
    {
        $investor->update([
            'confirmed' => 1,
            'confirmed_at' => Carbon::now()
        ]);

        return back();
    }

    public function rejected(Investor $investor)
    {
        $investor->personal()->delete();

        return back();
    }
}
