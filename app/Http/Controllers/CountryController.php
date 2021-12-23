<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class CountryController extends Controller
{
    private $country;

    /**
     * constructor
     */
    public function __construct()
    {
        $this->country = new Country();
    }

    /**
     * return list of countries data
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
     * get countries data from third party API: https://api.covid19api.com/summary
     * @param $scheduler
     * @return array|mixed|string
     */
    public function getAll($scheduler=false){
        $countriesDataSave = [];
        try{
            $response = Http::get('https://api.covid19api.com/summary');
            $countriesJsonList = $response->json()['Countries'];
            $countriesDataSave = $this->storeAllJson($countriesJsonList);
        }
        catch (Exception $e){
        }
        if(!$scheduler)
        return $countriesDataSave;

        return "Databases has been populated";
    }

    /**
     * store countries list
     * @param $countriesDataList
     * @return mixed
     */
    public function storeAllJson($countriesDataList){
        $data = $this->country->storeAllJson($countriesDataList);
        return $data;
    }

    /**
     * save single Country object
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function store(Request $request){
        $countryRequest= $request->get('country');
            $country = new Country();
            $country->storeJson($countryRequest);
            return response()->json('Country saved!');


    }

    /**
     * return list of country code and value (e.g., total confirmed cases) for map use
     * @return Collection
     */
    public function getKeyValue(): Collection
    {
         return Country::all()->pluck('TotalConfirmed','CountryCode');
    }

}
