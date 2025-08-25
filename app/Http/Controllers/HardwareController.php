<?php

namespace App\Http\Controllers;

use App\Imports\HardwareImport;
use App\Imports\HardwaresImport;
use App\Models\Hardware;
use App\Models\OrderPlaced;
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

    // public function showHardware()
    // {
    //     $filePath = storage_path('app/public/hardwares/sample-hardware');

    //     $file = null;

    //     if (file_exists($filePath . '.xlsx')) {
    //         $file = $filePath . '.xlsx';
    //     } elseif (file_exists($filePath . '.csv')) {
    //         $file = $filePath . '.csv';
    //     } else {
    //         return back()->with('error', 'No data file found.');
    //     }

    //     $hardwares = Excel::toArray(new HardwareImport, $file);

    //     $hardwares = $hardwares[0];

    //     return view('/website/ask_for_quote', compact('hardwares'));
    // }

    public function editHardwareDetails($hrdws_id)
    {

        \Log::info('Editing hardware details for ID: ' . $hrdws_id);

        $hardware = Hardware::where('hrdws_id', $hrdws_id)->first();


        if ($hardware) {
            return view('service-partner.marketplace_hardwares_details', compact('hardware'))->with('editMode', true);
        }

        return back()->with('error', 'Problem while fetching hardware details');
    }

    public function hardwareDetails($hrdws_id, $ordplcd_id){

        \Log::info('Fetching hardware details for ID:  Wth' . $hrdws_id);

        // OrderPlaced::where('ordplcd_hw_id', $hrdws_id)->first();

        $ordplcd = OrderPlaced::where('ordplcd_hw_id', $hrdws_id)->first();

        $hardware = Hardware::where('hrdws_id', $hrdws_id)->first();

        if ($hardware) {
            return view('service-partner.hardware_details', compact('hardware', 'ordplcd'));
        }

        return back()->with('error', 'Problem while fetching hardware details');
    }

    // public function updateHardware(Request $request, $hrdws_id){

    //     \Log::info('Updating hardware details for ID: ' . $hrdws_id);

    //     $hardware = Hardware::where('hrdws_id', $hrdws_id)->first();

    //     if (!$hardware) {

    //         return back()->with('error', 'Hardware not found');

    //     }

    //     $hardware->update($request->all());

    //     return back()->with('success', 'Hardware updated successfully');
    // }

    public function updateHardware(Request $request, $hrdws_id)
    {
        \Log::info('Updating hardware details for ID: ' . $hrdws_id);
        \Log::info('Request Data:', $request->all());

        $hardware = Hardware::where('hrdws_id', $hrdws_id)->first();

        if (!$hardware) {
            return back()->with('error', 'Hardware not found');
        }

        // Optional: Validation
        $request->validate([
            'serialNumber' => 'required|string',
            'hardwareIdentifier' => 'required|string',
            'modelNumber' => 'required|string',
            'modelDescription' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'family' => 'nullable|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
        ]);

        // Manually assign values
        $hardware->hrdws_serial_number = $request->serialNumber;
        $hardware->hrdws_hw_identifier = $request->hardwareIdentifier;
        $hardware->hrdws_model_number = $request->modelNumber;
        $hardware->hrdws_model_description = $request->modelDescription;
        $hardware->hrdws_qty = $request->quantity;
        $hardware->hrdws_family = $request->family;
        $hardware->hrdws_city = $request->city;
        $hardware->hrdws_state = $request->state;

        $hardware->save();

        return back()->with('success', 'Hardware updated successfully');
    }

    public function destroy($id)
    {
        \Log::info('Deleting hardware with ID: ' . $id);

        $hardware = Hardware::find($id);

        if (!$hardware) {
            return response()->json(['message' => 'Hardware not found.'], 404);
        }

        $hardware->delete();

        \Log::info('Hardware deleted successfully.');

        return response()->json(['message' => 'Hardware deleted successfully.']);
    }

}
