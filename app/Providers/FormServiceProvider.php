<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class FormServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // 커스텀 블레이드 디렉티브 등록 예시
        Blade::directive('formSelect', function ($expression) {
            return "<?php echo app('App\\Http\\Controllers\\Admx\\Component\\FormController')->generateSelect($expression); ?>";
        });

        Blade::directive('formInput', function ($expression) {
            return "<?php echo app('App\\Http\\Controllers\\Admx\\Component\\FormController')->generateInput($expression); ?>";
        });
    }
}
