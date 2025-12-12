<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Repositories\EventRepositoryInterface;
use App\Models\Event;
use App\Models\Organizer;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class EventController extends Controller
{
    protected EventRepositoryInterface $eventRepository;

    public function __construct(EventRepositoryInterface $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    public function index(): View
    {
        $search = request()->get('search', '');

        $events = Event::with('organizer')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', '%' . request()->get('search', '') . '%');
            })
            ->latest()
            ->paginate(4);

        return view('events.index', compact('events', 'search'));
    }

    public function create(): View
    {
        $organizers = Organizer::orderBy('name')->get();

        return view('events.create', compact('organizers'));
    }

    public function store(StoreEventRequest $request): RedirectResponse
    {
        $this->eventRepository->create($request->validated());

        return redirect()->route('events.index')
            ->with('success', 'Event created successfully.');
    }

    public function show(Event $event): View
    {
        $event->load('organizer');

        return view('events.show', compact('event'));
    }

    public function edit(Event $event): View
    {
        $organizers = Organizer::orderBy('name')->get();

        return view('events.edit', compact('event', 'organizers'));
    }

    public function update(UpdateEventRequest $request, Event $event): RedirectResponse
    {
        $this->eventRepository->update($event, $request->validated());

        return redirect()->route('events.index')
            ->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event): RedirectResponse
    {
        $this->eventRepository->delete($event);

        return redirect()->route('events.index')
            ->with('success', 'Event deleted successfully.');
    }
}
