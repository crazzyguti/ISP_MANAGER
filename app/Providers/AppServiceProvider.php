<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Blade;
use App\View\Components\Modal;
use App\View\Components\Alert;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * All of the container bindings that should be registered.
     *
     * @var array
     */
    public $bindings = [
        // ServerProvider::class => DigitalOceanServerProvider::class,
    ];

    /**
     * All of the container singletons that should be registered.
     *
     * @var array
     */
    public $singletons = [
        // DowntimeNotifier::class => PingdomDowntimeNotifier::class,
        // ServerToolsProvider::class => ServerToolsProvider::class,
    ];

    public function boot()
    {

        View::share('_TOKEN', csrf_token());


        Blade::component(Modal::class, 'modal');
        Blade::component(Alert::class, 'alert');

        //Blade::include('components.alert', 'alert');
    }
}
