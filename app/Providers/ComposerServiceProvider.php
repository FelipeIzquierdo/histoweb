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
            'Histoweb\Http\ViewComposers\FormulateComposer' => 'dashboard.pages.assistance.formulate.formm',
            'Histoweb\Http\ViewComposers\AssistanceComposer' => 'dashboard.pages.assistance.entry',
            'Histoweb\Http\ViewComposers\VideoconferencingComposer' => 'dashboard.pages.videoconferencing.home',
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
