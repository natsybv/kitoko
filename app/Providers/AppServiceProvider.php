<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;

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
      Route::resourceVerbs([
        'create' => 'creer',
        'edit' => 'editer',
      ]);

      Blade::directive('datetime', function ($expression) {
          return "<?php echo ($expression)->format('d/m/Y à H:i'); ?>";
      });

      Blade::directive('price', function ($expression) {
          return "<?php echo number_format($expression, 0, ',', ' ').' FCFA'; ?>";
      });
    }
}
