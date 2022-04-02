<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'admin') {
            $tickets = Ticket::orderBy('id', 'desc')->paginate(10);
        } else {
            $tickets = Ticket::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(10);
        }
        return view('admin.tickets.index', compact('tickets'));
    }

    public function show($id)
    {
        $ticket = Ticket::findOrFail($id);
        $messages = TicketMessage::where('ticket_id', $id)->orderBy('id', 'desc')->get();
        return view('admin.tickets.show', compact('ticket', 'messages'));

    }

    public function create()
    {
        return view('admin.tickets.create');

    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'text' => 'required',
        ]);
        $ticket = Ticket::create([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'state' => 'opened'
        ]);
        TicketMessage::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::user()->id,
            'message' => $request->text
        ]);
        return redirect('/tickets');
    }

    public function close($id)
    {
        $ticket = Ticket::findOrFail($id);
        Ticket::updateOrCreate(['id' => $ticket->id], [
            'state' => 'closed'
        ]);
        return redirect('/tickets');
    }

    public function pend($id)
    {
        $ticket = Ticket::findOrFail($id);
        Ticket::updateOrCreate(['id' => $ticket->id], [
            'state' => 'pending'
        ]);
        return redirect('/tickets');
    }


    public function sendMessage($id, Request $request)
    {
        $validatedData = $request->validate([
            'text' => 'required',
        ]);
        $ticket = Ticket::findOrFail($id);
        Ticket::updateOrCreate(['id' => $ticket->id], [
            'state' => Auth::user()->role == 'admin' ? 'admin_message' : 'user_message'
        ]);
        TicketMessage::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::user()->id,
            'message' => $request->text,
        ]);
        return back();
    }

}
