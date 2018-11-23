<?php

namespace App\Http\Controllers\Admin;

use App\Models\Investor;
use App\Services\UnisenderService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

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

        return [
            'status' => true
        ];
    }

    public function rejected(Investor $investor)
    {
        $documents = $investor->personal()->first()->documents()->get();

        foreach ($documents as $document){
            Storage::delete('uploads/documents/' . $document->img);
        }

        $investor->personal()->delete();

        $this->unisenderService->sendEmail($investor->email,
            __('mails/mails.rSubject'),
            view('mails.account_rejected')->render());

        return [
            'status' => true
        ];
    }

    public function get()
    {
        $investors = Investor::has('personal')->with('personal.documents')->get();

        return $investors;
    }
}
