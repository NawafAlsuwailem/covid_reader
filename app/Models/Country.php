<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Country extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table='countries';

    /**
     * fillable element for object Country
     * @var string[]
     */
    protected $fillable = [
        'Country',
        'CountryCode',
        'Slug',
        'NewConfirmed',
        'TotalConfirmed',
        'NewDeaths',
        'TotalDeaths',
        'NewRecovered',
        'TotalRecovered',
        'Date'
    ];

    /**
     * return country by id
     * @param $id
     * @return \Illuminate\Database\Query\Builder|mixed
     */
    public static function find($id)
    {
        return DB::table('countries')->find($id);
    }

    /**
     * store list of countries in json format
     * @param $countriesDataList
     * @return mixed
     */
    public function storeAllJson($countriesDataList){
        foreach ($countriesDataList as $country){
            $this->storeJson($country);
        }
        return $countriesDataList;
    }

    /**
     * store single object for json
     * @param $country
     * @return void
     * @throws \Exception
     */
    public function storeJson($country){
        $date = date("Y/m/d H:i:s");
        if(isset($country['Date'])){
            $date=  $country['Date'];
        }
        DB::table('countries')->updateOrInsert(
            ['Country' => $country['Country'],
                'Slug' => $country['Slug']],
            [
                'Country' => $country['Country'],
                'CountryCode' => $country['CountryCode'],
                'Slug' => $country['Slug'],
                'NewConfirmed' => $country['NewConfirmed'],
                'TotalConfirmed' => $country['TotalConfirmed'],
                'NewDeaths' => $country['NewDeaths'],
                'TotalDeaths' => $country['TotalDeaths'],
                'NewRecovered' => $country['NewRecovered'],
                'TotalRecovered' => $country['TotalRecovered'],
                'Date' => date_format(new datetime($date), "Y/m/d H:i:s"),
            ]);
    }
}
