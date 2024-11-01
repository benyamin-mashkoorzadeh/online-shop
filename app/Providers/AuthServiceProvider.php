<?php

namespace App\Providers;

use App\Models\Content\Post;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

//        Gate::define('update-post', function (User $user, Post $post) {
//            return $user->id === $post->author_id;
//        });

//        Gate::define('update-post', function (User $user, Post $post) {
//            return $user->id === $post->author_id;
//        });
    }
}
