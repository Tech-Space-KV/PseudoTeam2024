<?php

namespace App\Http\Controllers;

use App\Mail\TicketRaised;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TicketController extends Controller
{
    public function storeTicket(Request $request) 
    {  

        $customerId = session('user_id');

        if (!$customerId) {

            return redirect()->back()->with('error', 'Customer ID not found!');
        }

        $validated = $request->validate([
            'tckt_title' => 'required|string|max:255',
            'tckt_description' => 'required|string',
            'tckt_attachment' => 'nullable|file|mimes:pdf,docx,doc|max:2048',
        ]);

        try {

            Ticket::create([
                'tckt_title' => $validated['tckt_title'],
                'tckt_description' => $validated['tckt_description'],
                'tckt_customer_id' => $customerId,
                'tckt_attachment' => $validated['tckt_attachment'] ?? null, 
            ]);

            //need to change the reciever email address
            Mail::to('sanskarsharma0119@gmail.com')->send(new TicketRaised(
                $validated['tckt_title'],
                $validated['tckt_description'],
                $customerId
            ));

            return redirect()->back()->with('success', 'Ticket has been uploaded successfully.');

        } catch (\Throwable $e) {
            \Log::error('Error storing ticket: ' . $e->getMessage(), [
                'exception' => [
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'trace' => $e->getTraceAsString(),
                ]
            ]);

            return redirect()->back()->with('error', 'Ticket has not been uploaded successfully.');
        }
    }

    public function fetchTickets() 
    {
        $customerId = session('user_id');

        $tickets = Ticket::where('tckt_customer_id' , $customerId)->get();

        return view('customer.trackticket' , compact('tickets'));      
    }

    public function ticketDetails($tckt_id)
    {
        $ticket = Ticket::where('tckt_id' , $tckt_id)->first();

        return view('customer.ticket' , ['ticket' => $ticket, 'readonly' => true]);
    }
}
