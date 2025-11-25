<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        \App\Models\Producto::class => null,
    ];

    public function boot(): void
    {
        // 🔧 Evita que Laravel busque policies automáticamente
        Gate::guessPolicyNamesUsing(fn() => null);
    }
}
