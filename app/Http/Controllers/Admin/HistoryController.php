<?php

namespace App\Http\Controllers\Admin;

use App\Models\InvestorHistoryFields;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HistoryController extends Controller
{
    public function index()
    {
        return view('admin.history');
    }

    public function get()
    {
        $histories = InvestorHistoryFields::get();

        return $histories;
    }
}
