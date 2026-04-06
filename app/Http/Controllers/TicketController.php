<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Auth::user()->tickets()->with('order')->latest()->get();
        return view('tickets.index', compact('tickets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'nullable|exists:orders,id',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        if ($request->order_id) {
            Order::where('id', $request->order_id)->where('user_id', Auth::id())->firstOrFail();
        }

        Auth::user()->tickets()->create([
            'order_id' => $request->order_id,
            'subject' => $request->subject,
            'message' => $request->message,
            'status' => 'pending',
            'is_seen_by_user' => true
        ]);

        // Si es un reporte de producto, incrementar contador y pausar si llega a 10
        if (str_contains($request->subject, 'Reporte de Producto ID:')) {
            $productId = (int) str_replace('Reporte de Producto ID: ', '', $request->subject);
            $product = \App\Models\Product::find($productId);
            if ($product) {
                $product->increment('reports_count');
                if ($product->reports_count >= 10) {
                    $product->update(['is_paused' => true]);
                }
            }
        }

        return back()->with('success', __('Tu reporte ha sido enviado con éxito.'));
    }

    public function show(Ticket $ticket)
    {
        if ($ticket->user_id !== Auth::id()) {
            abort(403);
        }

        $ticket->update(['is_seen_by_user' => true]);

        return view('tickets.show', compact('ticket'));
    }
}
