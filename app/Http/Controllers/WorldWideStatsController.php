<?php

namespace App\Http\Controllers;

use App\Models\WorldWide;
use DateTime;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class WorldWideStatsController extends Controller
{
    /**
     *
     * @return WorldWide[]|Collection
     */
    public function index()
    {
        if (!DB::table('world_wides')->exists() || DB::table('world_wides')->count() == 0){
            $this->get();
        }
        return WorldWide::all();
    }

    /**
     * get and save worldwide stats data from third party API
     * @param $scheduler
     * @return string
     */
    public function get($scheduler=false){
        $response = Http::get('https://api.covid19api.com/summary');
        $worldwideJson = $response->json()['Global'];
        $worldwideJsonDataSave = $this->save($worldwideJson);
        if(!$scheduler)
        return $worldwideJsonDataSave;

        return "Databases has been populated";
    }

    /**
     * save worldwide stats data
     * @param $worldwideJson
     * @return mixed
     */
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

    /**
     * get worldwide stats data
     * @return WorldWide|mixed
     */
    public function getStats(){
        $worldwideData = $this->index()[0];
        unset($worldwideData["id"], $worldwideData["Date"]);
        return $worldwideData;
    }
}
