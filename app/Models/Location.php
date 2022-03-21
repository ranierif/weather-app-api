<?php

namespace App\Models;

use App\Events\UpdateWeatherEvent;
use App\Jobs\UpdateWeather;
use App\Models\Weather;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'city',
        'lat',
        'lon'
    ];

    protected $table = 'locations';

    public $timestamps = false;

    /**
     * @param null $date
     * @return mixed
     */
    public function getWeather($date = null){

        $date = ($date) ? $date : date('Y-m-d');
        $dataWeather = $this->weather()->where('date', $date)->first();
        if(!$dataWeather){
            $weather = New Weather;
            $data = $weather->getWeatherLocationDataFromService($this);
            if($data['status']) {
                event(new UpdateWeatherEvent($this, $date, $data));
                return ['status' => true, 'details' => $data['data']];
            }
        }

        return ['status' => true, 'details' => json_decode($dataWeather->details, true)];

    }

    /**
     * Get the Weather of location.
     *
     * @return Weather
     */
    public function Weather(){
        return $this->hasMany('App\Models\Weather', 'location_id', 'id');
    }
}
