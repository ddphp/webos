<?php

namespace App\Providers;

use App\Contracts\Voting\ManageImages;
use App\Contracts\Voting\QueryPlayers;
use App\Models\Voting\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Serv\ManageTpImages;
use Serv\QueryTpPlayers;

class VotingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(\App\Http\Controllers\Voting\Index::class)
            ->needs(Activity::class)
            ->give(function () {
                $request = app(Request::class);
                $actId = $request->activity ?: $request->actid;
                return Activity::findOrFail($actId);
            });

        $this->app->bind(QueryPlayers::class, QueryTpPlayers::class);
        $this->app->bind(ManageImages::class, ManageTpImages::class);
    }
}
