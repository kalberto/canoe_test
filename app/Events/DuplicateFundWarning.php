<?php

namespace App\Events;

use App\Models\Fund;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DuplicateFundWarning
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Fund $fund;

    public function __construct(Fund $fund)
    {
        $this->fund = $fund;
    }
}
