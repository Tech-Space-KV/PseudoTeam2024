<?php

namespace App\Http\Controllers;

use App\Imports\HardwaresImport;
use App\Models\Hardware;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class HardwareController extends Controller
{
    public function storeHardware(Request $request)
    {

        $request->validate([
            'hrdws_serial_number' => 'required|string|max:255',
            'hrdws_model_number' => 'required|string|max:255',
            'hrdws_qty' => 'required|integer',
            'hrdws_family' => 'required|string|max:255',
            'hrdws_city' => 'required|string|max:255',
            'hrdws_state' => 'required|string|max:255',
            'hrdws_price' => 'required|numeric',
            'hrdws_hw_identifier' => 'required|string|max:255',
            'hrdws_model_description' => 'required|string|max:255',
        ]);


        Hardware::create([
            'hrdws_sp_id' => session('sp_user_id'),
            'hrdws_serial_number' => $request->hrdws_serial_number,
            'hrdws_model_number' => $request->hrdws_model_number,
            'hrdws_qty' => $request->hrdws_qty,
            'hrdws_family' => $request->hrdws_family,
            'hrdws_city' => $request->hrdws_city,
            'hrdws_state' => $request->hrdws_state,
            'hrdws_price' => $request->hrdws_price,
            'hrdws_hw_identifier' => $request->hrdws_hw_identifier,
            'hrdws_model_description' => $request->hrdws_model_description,
        ]);

        return back()->with('success', 'Hardware added successfully!');
    }

    public function importHardware(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');

        } else {

            return back()->withErrors(['file' => 'No file was uploaded.'])->withInput();
        }

        try {
            $request->validate([
                'file' => 'required|file|mimes:csv,xlsx,xls',
            ]);

        } catch (ValidationException $e) {

            return back()->withErrors($e->errors())->withInput();
        }

        try {

            $spId = session('sp_user_id');

            Excel::import(new HardwaresImport($spId), $request->file('file'));
            return back()->with('success', 'Hardware data imported successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['file' => 'Import failed: ' . $e->getMessage()]);
        }
    }


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

    public function spFetchHardware()
    {
        $hardwares = Hardware::where('hrdws_sp_id', session('sp_user_id'))->get();

        return view('service-partner.hardware', compact('hardwares'));
    }
}
