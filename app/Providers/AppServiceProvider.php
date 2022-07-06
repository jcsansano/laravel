<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\support\Facades\Blade;
use Illuminate\Pagination\Paginator;
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
    public function boot() {
        //incorporat
        Paginator::useBootstrap();
        //incorporat
        /*Blade::directive("priceformat", function($expressio){
            return "<?php echo number_format(floatval($expressio),2, ',', '.').\" €\"; ?>";
        });
        */
        Blade::directive("yes_no", function($expressio){
            return "<?php echo ($expressio == 'S')?'SI':'NO'; ?>";
        });
        
        Blade::directive("dataSimple", function($expressio){
            return "<?php echo date('d-m-Y',strtotime($expressio)); ?>"; 
        });
    }
}
