<?php

namespace App\Services;
use App\Models\Location;
use Carbon\Carbon;

class OpenWeatherService
{

    public function __construct()
    {
        $this->api_key = env('OPENWEATHER_API_KEY');
    }

    /**
     * @param Location $location
     * @return array|false[]
     */
    public function getCurrentWeatherData(Location $location, $date = null){

        if($date != date('Y-m-d')){
            $endpoint = 'https://history.openweathermap.org/data/3.0/history/timemachine?lat='.$location->lat.'&lon='.$location->lon.'&dt='.strtotime($date).'&appid='.$this->api_key;
        }else{
            $endpoint = 'https://api.openweathermap.org/data/2.5/weather?lat='.$location->lat.'&lon='.$location->lon.'&appid='.$this->api_key;
        }

        $data = $this->execCurl($endpoint);

        if($data && isset($data['coord'])){
            return ['status' => true, 'data' => $data];
        }

        return ['status' => false];
    }

    /**
     * @param $endppoint
     * @return mixed
     */
    public function execCurl($endppoint){

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $endppoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $json = json_decode($response, true);
        return $json;

    }

}
