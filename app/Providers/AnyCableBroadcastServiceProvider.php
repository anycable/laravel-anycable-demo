<?php

namespace App\Providers;

use App\Broadcasting\AnyCableBroadcaster;
use GuzzleHttp\Client;
use Illuminate\Broadcasting\BroadcastManager;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

class AnyCableBroadcastServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Broadcast::extend('anycable', function ($app, $config) {
            return new AnyCableBroadcaster(
                new Client(),
                $config
            );
        });
    }
}