<?php

namespace App\Http\Controllers;

use App\Models\Hardware;
use Illuminate\Http\Request;

class HardwareController extends Controller
{
    public function fetchHardware()
    {
        $hardwares = Hardware::all();

        return view('customer.marketplace_hardwares', compact('hardwares'));
    }

    public function fetchHardwareById($hrdws_id)
    {
        $hardware = Hardware::where('hrdws_id', $hrdws_id)->first();

        if ($hardware) {
            return view('customer.marketplace_hardwares_details', compact('hardware'));
        }

        return back()->with('error', 'Problem while fetching hardwares');
    }
}
