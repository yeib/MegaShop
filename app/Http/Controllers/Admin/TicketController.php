<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with('user', 'order')->latest()->paginate(10);
        return view('admin.tickets.index', compact('tickets'));
    }

    public function show(Ticket $ticket)
    {
        return view('admin.tickets.show', compact('ticket'));
    }

    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([
            'status' => 'required|in:pending,open,resolved,closed',
            'admin_response' => 'nullable|string',
        ]);

        $ticket->update([
            'status' => $request->status,
            'admin_response' => $request->admin_response,
            'is_seen_by_user' => false // Notificar al usuario que hay algo nuevo
        ]);

        return back()->with('success', __('Ticket actualizado y usuario notificado.'));
    }
}
