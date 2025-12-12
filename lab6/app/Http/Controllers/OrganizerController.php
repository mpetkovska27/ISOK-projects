<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrganizerRequest;
use App\Http\Requests\UpdateOrganizerRequest;
use App\Repositories\OrganizerRepositoryInterface;
use App\Models\Organizer;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class OrganizerController extends Controller
{
    protected OrganizerRepositoryInterface $organizerRepository;

    public function __construct(OrganizerRepositoryInterface $organizerRepository)
    {
        $this->organizerRepository = $organizerRepository;
    }

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
        $this->organizerRepository->create($request->validated());

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

        $this->organizerRepository->update($organizer, $request->validated());

        return redirect()->route('organizers.index')
            ->with('success', 'Organizer successfully updated.');
    }

    public function destroy(Organizer $organizer): RedirectResponse
    {

        $this->organizerRepository->delete($organizer);

        return redirect()->route('organizers.index')
            ->with('success', 'Organizer successfully deleted.');
    }
}
