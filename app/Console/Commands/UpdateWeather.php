<?php

namespace App\Console\Commands;

use App\Models\Weather;
use Illuminate\Console\Command;
use App\Models\Location;

class UpdateWeather extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:updateWeather';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update/Create Weather of Locations of day';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $date = date('Y-m-d');
        $locations = Location::get();
        foreach($locations as $location){
            $weather = New Weather;
            $details = $weather->getWeatherLocationDataFromService($location, $date);
            if($details['status']) {
                $weather->updateDate($location, $date, $details);
                $this->info($date . ': ' . $location->city . ' update Weather');
            }
        }
    }
}
