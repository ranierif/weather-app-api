<?php

namespace Tests\Unit;

use App\Models\Location;
use App\Models\User;
use Faker\Factory;
use Tests\TestCase;

class WeatherApiTest extends TestCase
{
    protected $user;

    /**
     * setUp API Auth
     */
    public function setUp():void
    {
        parent::setUp();

        $getUserApi = User::find(1);
        $this->user = ($getUserApi) ? $getUserApi : User::factory()->create();
        $this->actingAs($this->user, 'api');
    }

    /**
     * A test to get Weather Data passing any date.
     *
     * @param null $city
     * @param null $date
     *
     * @return void
     */
    public function test_get_weather_with_date($city = null, $date = null)
    {
        $faker = Factory::create();

        $date = ($date) ? $date : $faker->date('Y-m-d');
        $city = ($city) ? $city : Location::inRandomOrder()->first()->city;

        $formData = [
            'city' => $city,
            'date' => $date
        ];

        $this->json('GET', route('api.weather.data'), $formData)->assertStatus(200)->assertJson(['status' => true]);
    }

    /**
     * A test to get Weather Data of today.
     *
     * @param null $city
     *
     * @return void
     */
    public function test_get_weather_today($city = null)
    {
        $city = ($city) ? $city : Location::inRandomOrder()->first()->city;

        $formData = [
            'city' => $city
        ];

        $this->json('GET', route('api.weather.data'), $formData)->assertStatus(200)->assertJson(['status' => true]);
    }
}
