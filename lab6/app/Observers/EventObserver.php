<?php

namespace App\Observers;

use App\Models\Event;
use Illuminate\Support\Facades\Log;
class EventObserver
{
    /**
     * Handle the Event "created" event.
     */
    public function created(Event $event): void
    {
        $message = "New event has been created:{$event->name}";
        Log::info($message);
    }

    /**
     * Handle the Event "updated" event.
     */
    public function updated(Event $event): void
    {
        $message = "Event has been updated:{$event->name}";
        Log::info($message);
    }

    /**
     * Handle the Event "deleted" event.
     */
    public function deleted(Event $event): void
    {
        $message = "Event has been cancelled: {$event->name}.";
        Log::info($message);
    }

    /**
     * Handle the Event "restored" event.
     */
    public function restored(Event $event): void
    {
        //
    }

    /**
     * Handle the Event "force deleted" event.
     */
    public function forceDeleted(Event $event): void
    {
        //
    }
}
