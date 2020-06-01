<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // ese método  verificación
        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            $mail = new \App\Mail\VerifyEmail($notifiable, $url);
            return $mail;
        });
        // resetear el correo
        \Illuminate\Auth\Notifications\ResetPassword::toMailUsing(function ($notifiable, $token) {
            $mail = new \App\Mail\EmailReset($notifiable, url(route('password.reset', $token)));
            return $mail;
        });
    }
}
