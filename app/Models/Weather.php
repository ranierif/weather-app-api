<?php

namespace App\Models;

use App\Services\OpenWeatherService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'date',
        'location_id',
        'details'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date' => 'date',
    ];

    /**
     * @param Location $location
     * @param $date
     * @param $details
     */
    public function updateDate(Location $location, $date, $details){
        $dataWeather = self::where('date', $date)->where('location_id', $location->id)->first();
        if(!$dataWeather){
            self::create([
                'date' => $date,
                'location_id' => $location->id,
                'details' => json_encode($details['data']),
            ]);
        }
    }

    /**
     * @param Location $location
     * @return array|false[]
     */
    public function getWeatherLocationDataFromService(Location $location){
        $service = New OpenWeatherService;
        $data = $service->getCurrentWeatherData($location);
        return $data;
    }

    /**
     * Get the Location of weather.
     *
     * @return Location
     */
    public function location(){
        return $this->hasOne('App\Models\Location', 'id', 'location_id');
    }

}
