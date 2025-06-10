<?php

namespace App\Listeners;

use App\Events\UrlVisited;
use App\Models\Url;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class IncrementUrlClicks
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UrlVisited $event)
    {
        Url::where('short_code', $event->short_code)
            ->increment('clicks');
    }
}
