<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\User;
use App\Models\Feedback;
use App\Models\Formulir;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
     public function boot(): void
    {
        View::composer('*', function ($view) {
            $view->with([
                'notifUserBaru' => User::where('status', 'diproses')->count(),
                'notifFeedbackBaru' => Feedback::where('status', 'diproses')->count(),
                'notifFormulirBaru' => Formulir::where('status', 'diproses')->count(),
            ]);
        });
    }
}