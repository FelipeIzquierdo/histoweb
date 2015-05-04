<?php namespace Histoweb\Providers;

use Illuminate\Support\ServiceProvider;
use Histoweb\Components\Calendar\CalendarBuilder;

class CalendarServiceProvider extends  ServiceProvider{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app['calendar'] = $this->app->share(function($app)
        {
            $calendarBuilder = new CalendarBuilder($app['session.store']);
            return $calendarBuilder;
        });
    }
}