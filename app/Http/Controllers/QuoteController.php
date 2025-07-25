<?php

namespace App\Http\Controllers;

use App\Imports\HardwareImport;
use App\Imports\ServicesImport;
use App\Mail\QuoteRequestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class QuoteController extends Controller
{
    public function show()
    {

        $filePath_service = storage_path('app/public/services/services');

        $file = null;

        if (file_exists($filePath_service . '.xlsx')) {
            $file = $filePath_service . '.xlsx';
        } elseif (file_exists($filePath_service . '.csv')) {
            $file = $filePath_service . '.csv';
        } else {
            return back()->with('error', 'No data file found.');
        }

        $services = Excel::toArray(new ServicesImport, $file);

        $services = $services[0];

        $filePath = storage_path('app/public/hardwares/sample-hardware');

        $file = null;

        if (file_exists($filePath . '.xlsx')) {
            $file = $filePath . '.xlsx';
        } elseif (file_exists($filePath . '.csv')) {
            $file = $filePath . '.csv';
        } else {
            return back()->with('error', 'No data file found.');
        }

        $hardwares = Excel::toArray(new HardwareImport, $file);

        $hardwares = $hardwares[0];

        return view('/website/ask_for_quote', compact('hardwares', 'services'));
    }

    public function sendQuoteMail(Request $request)
    {

        \Log::info('SendQuoteMail method called!');

        // Validate incoming form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'contact' => 'required|string|max:50',
            'company' => 'nullable|string|max:255',
            'query' => 'required|string',
            'selected_services' => 'nullable|string',
            'selected_spares' => 'nullable|string',
        ]);

        \Log::info('SendQuoateMail method validation successfull');

        // Parse selected service and spare IDs (comma-separated string)
        $selectedServices = $request->filled('selected_services')
            ? explode(',', $request->input('selected_services'))
            : [];

        $selectedSpares = $request->filled('selected_spares')
            ? explode(',', $request->input('selected_spares'))
            : [];

        Mail::to('sanskarsharma0119@gmail.com')->send(
            new QuoteRequestMail(
                $request->only(['name', 'email', 'contact', 'company', 'query']),
                $selectedServices,
                $selectedSpares
            )
        );

        \Log::info('SendQuoateMail Method Mail Sent Successfully!');

        return back()->with('success', 'Your quote request has been sent successfully.');
    }
}
