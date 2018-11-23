<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function get($path)
    {
        if (!Storage::disk('local')->exists('uploads/documents/' . $path)) {
            abort(404);
        }

        $local_path = config('filesystems.disks.local.root') . DIRECTORY_SEPARATOR . 'uploads/documents/' .  $path;

        return response()->file($local_path);
    }
}
