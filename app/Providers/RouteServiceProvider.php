<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    public  $api_routes_path = [
        ['folder' => 'Authentication', 'file' => 'auth_routes'],
        ['folder' => 'Agent', 'file' => 'agent_routes'],
        ['folder' => 'Plan', 'file' => 'plan_routes'],
        ['folder' => 'Scheme', 'file' => 'scheme_routes'],
        ['folder' => 'Customer', 'file' => 'customer_routes'],
        ['folder' => 'Transaction', 'file' => 'transaction_routes'],
        ['folder' => 'Location', 'file' => 'location_routes'],
        ['folder' => 'Payment', 'file' => 'payment_routes'],
        ['folder' => 'Statistics', 'file' => 'statistics_routes'],
        ['folder' => 'Complement', 'file' => 'complement_routes'],
    ];

    // protected $namespace = 'App\\Http\\Controllers';
    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            //Route for api controlls
            foreach ($this->api_routes_path as $route) {

                Route::prefix('api/v1')
                    ->middleware('api')
                    ->namespace($this->namespace)
                    ->group(base_path("routes/Api/{$route['folder']}/{$route['file']}.php"));
            }


            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
