<?php

namespace App\Jobs;

use App\Models\Weather;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Location;

class UpdateWeather implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $location;
    private $date;

    /**
     * Create a new job instance.
     *
     * @param Location $location
     * @param $date
     *
     * @return void
     */
    public function __construct($location, $date)
    {
        $this->location = $location;
        $this->date = $date;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $weather = New Weather;
        $weather->updateDate($this->location, $this->date);
    }
}
