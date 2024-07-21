<?php

namespace App\Observers;

use Illuminate\Support\Facades\Cache;

use App\Models\Event;

class EventObserver
{
    /**
     * Handle the Event "created" event.
     */
    public function created(Event $event): void
    {
        Cache::forget('events_list');
    }

    /**
     * Handle the Event "updated" event.
     */
    public function updated(Event $event): void
    {
        Cache::forget('events_list');
    }

    /**
     * Handle the Event "deleted" event.
     */
    public function deleted(Event $event): void
    {
        Cache::forget('events_list');
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
