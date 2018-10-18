<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function uploadAvatar(Request $request)
    {
        $investor = Auth::user();

        $img = $request->file('avatar');
        $img = $img->storeAs('uploads','avatar_' . Carbon::now()->format('ymd_his') . '_investor_id_' . $investor->id . '.' . $img->extension());

        $investor->img = $img;
        $investor->save();
    }
}
