<?php

namespace Laravel\BoostCline;

use Illuminate\Support\ServiceProvider;
use Laravel\Boost\BoostManager;

class ClineServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/cline.php', 'boost.agents.cline'
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Publish configuration file
        $this->publishes([
            __DIR__.'/../config/cline.php' => config_path('boost.agents.cline.php'),
        ], 'config');

        // Register the Cline agent with Laravel Boost after the manager is resolved
        $this->app->afterResolving(BoostManager::class, function (BoostManager $manager) {
            // Register the Cline agent if not already registered
            if (!array_key_exists('cline', $manager->getAgents())) {
                $manager->registerAgent('cline', ClineAgent::class);
            }
        });
    }
}