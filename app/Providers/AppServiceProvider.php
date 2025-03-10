<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Request;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {}

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        } else {
            // Obtém o locale do IP do usuário
            $locale = $this->getUserLocale();
            Session::put('locale', $locale);
            App::setLocale($locale);
        }
    }

    private function getUserLocale()
    {
        $ip = Request::ip();

        $countryCode = json_decode(file_get_contents("http://ip-api.com/json/{$ip}"))->countryCode ?? 'US';

        $locales = [
            'US' => 'en', // Inglês
            'GB' => 'en', // Inglês
            'ES' => 'es', // Espanhol
            'BR' => 'br', // Português Brasil
            'DE' => 'de', // Alemão
            'FR' => 'fr', // Francês
            'CN' => 'ch', // Chinês
            'IN' => 'in', // Indiano
            'RU' => 'ru', // Russo
        ];

        return $locales[$countryCode] ?? 'en';
    }
}
