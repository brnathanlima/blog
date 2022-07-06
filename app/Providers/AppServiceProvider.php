<?php

namespace App\Providers;

use App\Interfaces\Newsletter;
use App\Models\User;
use App\Services\MailchimpNewsletter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use MailchimpMarketing\ApiClient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        app()->bind(Newsletter::class, function() {
            $client = (new ApiClient())->setConfig([
                'apiKey' => config('services.mailchimp.api_key'),
                'server' => 'us12'
            ]);

            return new MailchimpNewsletter($client);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Paginator::useBootstrap();
        Model::unguard();

        Gate::define('admin', function (User $user) {
            return $user->username === 'brnathanlima';
        });

        Blade::if('admin', function () {
            return request()->user()?->can('admin');
        });
    }
}
