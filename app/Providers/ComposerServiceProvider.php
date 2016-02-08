<?php namespace Histoweb\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composers([
            'Histoweb\Http\ViewComposers\FormulateComposer' => 'dashboard.pages.assistance.formulate.form',
            'Histoweb\Http\ViewComposers\AssistanceComposer' => 'dashboard.pages.assistance.entry',
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
