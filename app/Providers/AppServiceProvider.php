<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $systemRoot = getenv('SystemRoot') ?: (getenv('WINDIR') ?: 'C:\Windows');
            putenv("SystemRoot={$systemRoot}");
            putenv("WINDIR={$systemRoot}");
            putenv("SYSTEMDRIVE=" . substr($systemRoot, 0, 2));
            $_ENV['SystemRoot'] = $systemRoot;
            $_SERVER['SystemRoot'] = $systemRoot;
            $_ENV['WINDIR'] = $systemRoot;
            $_SERVER['WINDIR'] = $systemRoot;
        }
    }
}
