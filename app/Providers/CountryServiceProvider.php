<?php

namespace App\Providers;

use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class CountryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    public function saveAll($countriesDataList){
        foreach ($countriesDataList as $country){
            $this->save($country);
        }
        return $countriesDataList;
    }


}
