<?php

namespace App\Providers;

use App\Player;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Game' => 'App\Policies\GamePolicy',
        'App\Player' => 'App\Policies\PlayerPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Auth::viaRequest('cah-token', function ($request) {
            return Player::validateCahToken($request->cah_token);
        });
    }
}
