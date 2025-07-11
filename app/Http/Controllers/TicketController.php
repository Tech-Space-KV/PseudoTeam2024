<?php

namespace App\Http\Controllers;

use App\Mail\TicketRaised;
use App\Mail\TicketRaisedCopy;
use App\Models\ProjectOwner;
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
            'tckt_attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx,csv|max:5120', // 5MB max size
        ]);

        try {

            $attachmentPath = null;

            if ($request->hasFile('tckt_attachment')) {
                // $attachmentPath = $request->file('tckt_attachment')->store('attachments', 'public');
                $attachmentContent = file_get_contents($request->file('tckt_attachment')->getRealPath());
            }

            $ticket = Ticket::create([
                'tckt_title' => $validated['tckt_title'],
                'tckt_description' => $validated['tckt_description'],
                'tckt_customer_id' => $customerId,
                'tckt_attachment' => $attachmentContent ?? null,
            ]);

            $name = ProjectOwner::where('pown_id', $customerId)->value('pown_name');
            $email = ProjectOwner::where('pown_id', $customerId)->value('pown_email');

            Mail::to('sanskarsharma0119@gmail.com')->send(new TicketRaisedCopy(
                $ticket->tckt_id,
                $name,
                $email,
                $ticket->tckt_title,
                $ticket->tckt_description
            ));

            //need to change the reciever email address
            Mail::to($email)->send(new TicketRaised(
                $validated['tckt_title'],
                $validated['tckt_description'],
                $customerId,
                $ticket->tckt_id,
                $name

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

        $tickets = Ticket::where('tckt_customer_id', $customerId)->get();

        return view('customer.trackticket', compact('tickets'));
    }

    public function ticketDetails($tckt_id)
    {
        $ticket = Ticket::where('tckt_id', $tckt_id)->first();

        return view('customer.ticket', ['ticket' => $ticket, 'readonly' => true]);
    }

    public function viewAttachment($id)
    {
        $ticket = Ticket::findOrFail($id);

        if (!$ticket->tckt_attachment) {
            abort(404, 'No attachment found.');
        }

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_buffer($finfo, $ticket->tckt_attachment);
        finfo_close($finfo);

        return response($ticket->tckt_attachment)
            ->header('Content-Type', $mime ?? 'application/octet-stream')
            ->header('Content-Disposition', 'inline; filename="attachment"');
    }

}
