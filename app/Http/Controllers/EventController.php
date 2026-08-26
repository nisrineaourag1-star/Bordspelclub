<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Publieke lijst van alle evenementen.
     */
    public function index()
    {
        $events = Event::with('participants')->orderBy('event_date')->get();

        return view('events.index', [
            'events' => $events,
        ]);
    }

    /**
     * Detailpagina van één evenement, met inschrijvingslijst.
     */
    public function show(Event $event)
    {
        $event->load('participants');

        return view('events.show', [
            'event' => $event,
        ]);
    }

    /**
     * Ingelogde gebruiker schrijft zich in voor een evenement.
     */
    public function register(Request $request, Event $event)
    {
        $event->participants()->syncWithoutDetaching([
            $request->user()->id => ['registered_at' => now()],
        ]);

        return redirect()->route('events.show', $event)->with('status', 'Je bent ingeschreven!');
    }

    /**
     * Ingelogde gebruiker schrijft zich uit voor een evenement.
     */
    public function unregister(Request $request, Event $event)
    {
        $event->participants()->detach($request->user()->id);

        return redirect()->route('events.show', $event)->with('status', 'Je bent uitgeschreven.');
    }
}