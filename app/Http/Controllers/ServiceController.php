<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ServicesImport;

//Implemented by sanskar

class ServiceController extends Controller
{
    public function showServices()
    {

        set_time_limit(300);
        $filePath = storage_path('app/public/services/services');

        $file = null;

        if (file_exists($filePath . '.xlsx')) {
            $file = $filePath . '.xlsx';
        }
        elseif (file_exists($filePath . '.csv')) {
            $file = $filePath . '.csv';
        } else {
            return back()->with('error', 'No data file found.');
        }

        $services = Excel::toArray(new ServicesImport, $file);

        $services = $services[0]; 

        return view('/website/services1', compact('services'));
    }
}
