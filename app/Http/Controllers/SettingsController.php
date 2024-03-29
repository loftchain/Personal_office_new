<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function uploadAvatar(Request $request)
    {
        $investor = Auth::user();

        $img = $request->file('avatar');
        $img = $img->storeAs('uploads','avatar_' . Carbon::now()->format('ymd_his') . '_investor_id_' . $investor->id . '.' . $img->extension());
        $img = explode('/', $img);

        $investor->img = $img[1];
        $investor->save();
    }

    public function getAvatar($path)
    {
        if (!Storage::disk('local')->exists('uploads/' . $path)) {
            abort(404);
        }

        $local_path = config('filesystems.disks.local.root') . DIRECTORY_SEPARATOR . 'uploads/' .  $path;

        return response()->file($local_path);
    }
}
