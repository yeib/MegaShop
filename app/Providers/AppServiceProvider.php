<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

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
            if (Auth::check()) {
                $user = Auth::user();
                
                $pendingTicketsCount = 0;
                if ($user->role === 'admin') {
                    $pendingTicketsCount = Ticket::where('status', 'pending')->count();
                }
                
                $unseenTicketsCount = Ticket::where('user_id', $user->id)
                    ->where('is_seen_by_user', false)
                    ->count();

                $view->with('pendingTicketsCount', $pendingTicketsCount);
                $view->with('unseenTicketsCount', $unseenTicketsCount);
            }
        });
    }
}
