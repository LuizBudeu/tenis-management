<?php

namespace App\Providers;

use App\Models\TennisCourt;
use App\Policies\TennisCourtPolicy;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        TennisCourt::class => TennisCourtPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
    }
}
