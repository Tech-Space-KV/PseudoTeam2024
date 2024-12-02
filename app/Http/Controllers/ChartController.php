<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChartController extends Controller
{
    // Render the view
    public function index()
    {   
        return view('/customer/reports');
    }

    // Provide data for the chart
    public function getData()
    {
        // Example data (fetch this from your database instead)
        $statuses = [
            'pending' => 10,
            'delivered' => 30,
            'in_progress' => 20,
            'overdue' => 5,
        ];

        return response()->json($statuses);
    }
}
