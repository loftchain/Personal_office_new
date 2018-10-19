<?php

namespace App\Http\Controllers\Admin;

use App\Models\Investor;
use App\Services\UnisenderService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KycController extends Controller
{
    protected $unisenderService;

    public function __construct(UnisenderService $unisenderService)
    {
        $this->unisenderService = $unisenderService;
    }

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

        $this->unisenderService->sendEmail($investor->email,
            __('mails/mails.vSubject'),
            view('mails.account_verified')->render());

        return back();
    }

    public function rejected(Investor $investor)
    {
        $investor->personal()->delete();

        $this->unisenderService->sendEmail($investor->email,
            __('mails/mails.rSubject'),
            view('mails.account_rejected')->render());

        return back();
    }
}
