<?php

namespace App\Listeners;

use App\Events\DuplicateFundWarning;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class HandleDuplicatedFundWarning
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     */
    public function handle(DuplicateFundWarning $event): void
    {
        Log::warning("Duplicate fund detected. Duplicate: {$event->fund->name}");
    }
}
