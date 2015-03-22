<?php namespace Histoweb\Providers;

use Illuminate\Support\ServiceProvider;
use Histoweb\Components\Field\FieldBuilder;

class FieldServiceProvider extends  ServiceProvider{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app ['field']=$this->app->share(function($app)
        {
            $fieldBuilder = new FieldBuilder($app['form'], $app['view'], $app['session.store']);
            return $fieldBuilder;
        });
    }
}