<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrganizerRequest;
use App\Http\Requests\UpdateOrganizerRequest;
use App\Models\Organizer;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class OrganizerController extends Controller
{
    public function index(): View
    {
        $organizers = Organizer::withCount('events')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('organizers.index', compact('organizers'));
    }

    public function create(): View
    {
        return view('organizers.create');
    }

    public function store(StoreOrganizerRequest $request): RedirectResponse
    {
        Organizer::create($request->validated());

        return redirect()->route('organizers.index')
            ->with('success', 'Organizer successfully created.');
    }

    public function show(Organizer $organizer): View
    {
        $organizer->load('events');

        return view('organizers.show', compact('organizer'));
    }

    public function edit(Organizer $organizer): View
    {
        return view('organizers.edit', compact('organizer'));
    }

    public function update(UpdateOrganizerRequest $request, Organizer $organizer): RedirectResponse
    {
        $organizer->update($request->validated());

        return redirect()->route('organizers.index')
            ->with('success', 'Organizer successfully updated.');
    }

    public function destroy(Organizer $organizer): RedirectResponse
    {
        $organizer->delete();

        return redirect()->route('organizers.index')
            ->with('success', 'Organizer successfully deleted.');
    }
}
