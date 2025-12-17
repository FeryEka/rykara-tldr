<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

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
        Model::preventLazyLoading(! $this->app->environment('production'));

        if($this->app->environment('production')) {
        URL::forceScheme('https');
        }

        Gate::define('adminDashboard', function (User $user) {
            return $user->isSuperAdmin();
        });

        Gate::define('penulisDashboard', function (User $user) {
        return $user->isPenulis();
        });

        Gate::define('managePost', function (User $user, Post $post) {
            return $user->id === $post->author_id || $user->isPenulis();
        });
    }
}