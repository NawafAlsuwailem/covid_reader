<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\WorldWide;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class WorldWideStatsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return |WorldWide[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        if (!DB::table('world_wides')->exists() || DB::table('world_wides')->count() == 0){
            $this->get();
        }
        return WorldWide::all();
    }

    /**
     * @return |null
     */
    public function get($scheduler=false){
        $response = Http::get('https://api.covid19api.com/summary');
        $worldwideJson = $response->json()['Global'];
        $worldwideJsonDataSave = $this->save($worldwideJson);
        if(!$scheduler)
        return $worldwideJsonDataSave;

        return "Databases has been populated";
    }

    public function save($worldwideJson){
        try {
            DB::table('world_wides')->updateOrInsert(
                ['id' => 1],
                ['id'=>1,
                    'TotalConfirmed' => $worldwideJson['TotalConfirmed'],
                    'TotalDeaths' => $worldwideJson['TotalDeaths'],
                    'TotalRecovered' => $worldwideJson['TotalRecovered'],
                    'Date' => date_format(new datetime($worldwideJson['Date']), "Y/m/d H:i:s"),
                ]);
        } catch (\Exception $e) {
        }
        return $worldwideJson;
    }

    public function getStats(){
        $worldwideData = $this->index()[0];
        unset($worldwideData["id"], $worldwideData["Date"]);
        return $worldwideData;
    }
}
