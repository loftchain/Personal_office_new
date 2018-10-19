<?php

namespace App\Http\Controllers;

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
            'phone' => 'required|min:5|max:20',
            'zip' => 'required|min:3|max:15',
            'files' => 'required',
            'g-recaptcha-response' => 'required',
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

         if ($validator->fails()){
             return response()->json(['validation_error' => $validator->errors()]);
         }

        $investor = Auth::user();

        $dateBirth = [];
        $dateBirth[] = $request->day;
        $dateBirth[] = $request->month;
        $dateBirth[] = $request->year;
        $dateBirth = implode(' ', $dateBirth);

        $images = [];
        foreach ($request->file('files') as $key => $img){
            $extension = $img->extension();
            $path = $img->storeAs('uploads', $key . '_' . Carbon::now()->format('ymd_his') . '_investor_id_' . $investor->id . '.' . $extension);
            $path = explode('/', $path);
            $images[] = $path[1];
        }

        $investor->personal()->create([
            'name_surname' => $request->name,
            'phone' => $request->phone,
            'date_place_birth' => $dateBirth,
            'doc_img_path' => $images,
        ]);

        return back();
    }
}
