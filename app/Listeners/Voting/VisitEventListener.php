<?php

namespace App\Listeners\Voting;

use App\Events\Voting\VisitEvents;
use App\Models\Voting\Activity;
use App\Models\Voting\ActivityCount;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class VisitEventListener
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
     * @param  VisitEvents  $event
     * @return void
     */
    public function handle(VisitEvents $event)
    {
        /** @var Activity $Activity */
        $Activity = $event->activity;

        /** @var ActivityCount $Count */
        $Count = $Activity->activityCount;

        $Count->visitors ++;

        $Count->save();
    }
}
