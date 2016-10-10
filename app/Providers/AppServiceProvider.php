<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Set Carbon Settings
        Carbon::setLocale( 'en' );
        Carbon::setWeekStartsAt( Carbon::SATURDAY );
        Carbon::setWeekEndsAt( Carbon::FRIDAY );
        Carbon::setWeekendDays( [ Carbon::FRIDAY, Carbon::SATURDAY ] );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }
}
