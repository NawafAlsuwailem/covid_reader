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

    public static function find($id)
    {
        return DB::table('countries')->find($id);
    }


    public function storeAllJson($countriesDataList){
        foreach ($countriesDataList as $country){
            $this->storeJson($country);
        }
        return $countriesDataList;
    }

    public function storeJson($country){
//        dd($country);
        $date = date("Y/m/d H:i:s");
        if(isset($country['Date'])){
            $date=  $country['Date'];
        }
//        dd($date);
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
//        try {
//
//
//        } catch (\Exception $e) {
//        }
    }

//    public function update($country, $id){
//        try {
//            DB::table('countries')->updateOrInsert(
//                ['id' => $id],
//                [
//                    'Country' => $country['Country'],
//                    'CountryCode' => $country['CountryCode'],
//                    'Slug' => $country['Slug'],
//                    'NewConfirmed' => $country['NewConfirmed'],
//                    'TotalConfirmed' => $country['TotalConfirmed'],
//                    'NewDeaths' => $country['NewDeaths'],
//                    'TotalDeaths' => $country['TotalDeaths'],
//                    'NewRecovered' => $country['NewRecovered'],
//                    'TotalRecovered' => $country['TotalRecovered'],
//                    'Date' => date_format(new datetime($country['Date']), "Y/m/d H:i:s"),
//                ]);
//        } catch (\Exception $e) {
//        }
//    }

    public function store($request){
        $country = new Country([
            'Country' => $request->input('Country'),
            'CountryCode' => $request->input('CountryCode'),
            'Slug' => $request->input('Slug'),
            'NewConfirmed' => $request->input('NewConfirmed'),
            'TotalConfirmed' => $request->input('TotalConfirmed'),
            'NewDeaths' => $request->input('NewDeaths'),
            'TotalDeaths' => $request->input('TotalDeaths'),
            'NewRecovered' => $request->input('NewRecovered'),
            'TotalRecovered' => $request->input('TotalRecovered'),
            'Date' => $request->input('Date'),
        ]);
        $country->save();
        return response()->json('Country saved!');
    }
}
