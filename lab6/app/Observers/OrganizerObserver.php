<?php

namespace App\Observers;

use App\Models\Organizer;
use Illuminate\Support\Facades\Log;
class OrganizerObserver
{
    /**
     * Handle the Organizer "created" event.
     */
    public function created(Organizer $organizer): void
    {
        $message = "Organizer has been created:{$organizer->name}";
        Log::info($message);
    }

    /**
     * Handle the Organizer "updated" event.
     */
    public function updated(Organizer $organizer): void
    {
        $message = "Organizer has been updated:{$organizer->name}";
        Log::info($message);
    }

    /**
     * Handle the Organizer "deleted" event.
     */
    public function deleted(Organizer $organizer): void
    {
        $message = "Organizer has been deleted:{$organizer->name}";
        Log::info($message);
    }

    /**
     * Handle the Organizer "restored" event.
     */
    public function restored(Organizer $organizer): void
    {
        //
    }

    /**
     * Handle the Organizer "force deleted" event.
     */
    public function forceDeleted(Organizer $organizer): void
    {
        //
    }
}
