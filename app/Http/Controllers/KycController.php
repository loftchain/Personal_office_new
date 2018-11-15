<?php

namespace App\Http\Controllers;

use App\Models\PersonalDocumentField;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class KycController extends Controller
{
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|min:3|max:50',
            'phone' => 'required|numeric',
            'zip' => 'required|min:3|max:15',
            'address' => 'required|min:3|max:50',
            'telegram' => 'nullable|regex:(^([a-zA-Z_]+)(\d+)?$)',
            'g-recaptcha-response' => (env('APP_ENV') != 'local') ? 'required' : 'nullable'
        ]);
    }

    public function index()
    {
        return view('home.kyc', [
            'personal' => Auth::user()->personal()->first()
        ]);
    }

    public function store(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return response()->json(['validation_error' => $validator->errors()]);
        }

        $investor = Auth::user();
        $personal = $investor->personal()->first();

        $dateBirth = [];
        $dateBirth[] = $request->day;
        $dateBirth[] = $request->month;
        $dateBirth[] = $request->year;
        $dateBirth = implode(' ', $dateBirth);

        $investor->personal()->create([
            'name_surname' => $request->name,
            'phone' => $request->phone,
            'date_place_birth' => $dateBirth,
            'telegram' => $request->telegram,
            'permanent_address' => $request->address,
        ]);

        return [
            'kyc_success' => true
        ];
    }

    public function upload(Request $request)
    {
        $investor = Auth::user();

        $img = $request->file('qqfile');
        $extension = $img->extension();
        $path = $img->storeAs('uploads', str_random(5) . Carbon::now()->format('_ymd_his') . '_investor_id_' . $investor->id . '.' . $extension);
        $path = explode('/', $path);

        $investor->personal()->first()->documents()->create([
            'img' => $path[1]
        ]);

        return [
            'success' => true
        ];
    }
}
