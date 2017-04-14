<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Voting\VisitEvents' => [
            'App\Listeners\Voting\VisitEventListener',
        ],
        'App\Events\Voting\VoteEvents' => [
            'App\Listeners\Voting\VoteEventListener',
            'App\Listeners\Voting\AddPlayerVote'
        ],
        'App\Events\Voting\AddPlayer' => [
            'App\Listeners\Voting\AddPlayerListener'
        ],
        'App\Events\Voting\DelPlayer' => [
            'App\Listeners\Voting\DelPlayer'
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
