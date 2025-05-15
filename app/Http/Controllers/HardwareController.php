<?php

namespace App\Http\Controllers;

use App\Imports\HardwaresImport;
use App\Models\Hardware;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class HardwareController extends Controller
{
    // public function importHardware(Request $request)
    // {

    //     \Log::info('Importing hardware data', ['request' => $request->all()]);

    //     $request->validate([
    //         'file' => 'required|file|mimes:csv,xlsx,xls'
    //     ]);

    //     \Log::info('File validation passed');

    //     Excel::import(new HardwaresImport, $request->file('file'));

    //     \Log::info('Hardware data imported successfully');

    //     return back()->with('success', 'Hardware data imported successfully.');
    // }

    public function storeHardware(Request $request)
    {
        \Log::info('Storing hardware data', ['request' => $request->all()]);

        $request->validate([
            'hrdws_serial_number'     => 'required|string|max:255',
            'hrdws_model_number'      => 'required|string|max:255',
            'hrdws_qty'               => 'required|integer',
            'hrdws_family'            => 'required|string|max:255',
            'hrdws_city'              => 'required|string|max:255',
            'hrdws_state'             => 'required|string|max:255',
            'hrdws_price'             => 'required|numeric',
            'hrdws_hw_identifier'     => 'required|string|max:255',
            'hrdws_model_description' => 'required|string|max:255',
        ]);

        // Hardware::create($request->all());

        Hardware::create([
            'hrdws_sp_id'             => session('sp_user_id'),
            'hrdws_serial_number'     => $request->hrdws_serial_number,
            'hrdws_model_number'      => $request->hrdws_model_number,
            'hrdws_qty'               => $request->hrdws_qty,
            'hrdws_family'            => $request->hrdws_family,
            'hrdws_city'              => $request->hrdws_city,
            'hrdws_state'             => $request->hrdws_state,
            'hrdws_price'             => $request->hrdws_price,
            'hrdws_hw_identifier'     => $request->hrdws_hw_identifier,
            'hrdws_model_description' => $request->hrdws_model_description,
        ]);

        \Log::info('Hardware data stored successfully');

        return back()->with('success', 'Hardware data stored successfully.');
    }

    public function importHardware(Request $request)
    {
        \Log::info('Importing hardware data', ['request' => $request->except('_token')]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');

            // Log file details
            \Log::info('File details:', [
                'originalName' => $file->getClientOriginalName(),
                'extension' => $file->getClientOriginalExtension(),
                'mimeType' => $file->getMimeType(),
                'guessedExtension' => $file->guessExtension(),
            ]);
        } else {
            \Log::warning('No file detected in the request.');
            return back()->withErrors(['file' => 'No file was uploaded.'])->withInput();
        }

        // Validate file type
        try {
            $request->validate([
                'file' => 'required|file|mimes:csv,xlsx,xls',
            ]);
            \Log::info('File validation passed.');
        } catch (ValidationException $e) {
            \Log::error('Validation failed:', $e->errors());
            return back()->withErrors($e->errors())->withInput();
        }

        // Proceed with import
        try {

            $spId = session('sp_user_id');

            \Log::info('Service Provider ID:', ['spId' => $spId]);

            Excel::import(new HardwaresImport($spId), $request->file('file'));
            \Log::info('Hardware data imported successfully.');
            return back()->with('success', 'Hardware data imported successfully.');
        } catch (\Exception $e) {
            \Log::error('Import failed: ' . $e->getMessage());
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
        $hardwares = Hardware::where('hrdws_sp_id' , session('sp_user_id'))->get();

        return view('service-partner.hardware', compact('hardwares'));
    }
}
