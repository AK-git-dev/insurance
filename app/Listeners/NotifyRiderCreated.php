<?php

namespace App\Listeners;

use App\Events\RiderCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyRiderCreated
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  RiderCreated  $event
     * @return void
     */
    public function handle(RiderCreated $event)
    {
        //
    }
}
