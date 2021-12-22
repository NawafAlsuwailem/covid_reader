<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Providers\CountryServiceProvider;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class CountryController extends Controller
{
    private $country;

    public function __construct()
    {
        $this->country = new Country();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Country[]|\Illuminate\Database\Eloquent\Collection
     */

    public function index()
    {

        if (!DB::table('countries')->exists() || DB::table('countries')->count() == 0){
            $this->getAll();
        }

        return Country::all();
    }

    /**
     * @return |null
     */
    public function getAll($scheduler=false){
        $countriesDataSave = [];
        try{
            $response = Http::get('https://api.covid19api.com/summary');
            $countriesJsonList = $response->json()['Countries'];
            $countriesDataSave = $this->storeAllJson($countriesJsonList);
        }
        catch (\Exception $e){
        }
        if(!$scheduler)
        return $countriesDataSave;

        return "Databases has been populated";
    }

    public function storeAllJson($countriesDataList){
        $data = $this->country->storeAllJson($countriesDataList);
        return $data;
    }

    public function store(Request $request){

        $countryRequest= $request->get('country');
            $country = new Country();
            $country->storeJson($countryRequest);
            return response()->json('Country saved!');


    }

    public function getKeyValue(): \Illuminate\Support\Collection
    {
         return Country::all()->pluck('TotalConfirmed','CountryCode');
    }

}
