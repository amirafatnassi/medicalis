<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        //
    ];

    public function boot(): void
    {
        $this->registerPolicies();

        Route::prefix('email')->group(function () {
            VerifyEmail::toMailUsing(function ($notifiable, $url) {
                return (new \Illuminate\Notifications\Messages\MailMessage)
                    ->subject('Verify Email Address')
                    ->line('Click the button below to verify your email address.')
                    ->action('Verify Email Address', $url)
                    ->line('If you did not create an account, no further action is required.');
            });
        });
    }
}
