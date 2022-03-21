<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\UpdateWeatherEvent;
use App\Models\Weather;

class UpdateWeatherListener implements ShouldQueue
{
    /**
     * Push a new job onto the queue.
     **/
    public function queue($queue, $job, $data)
    {
        return $queue->pushOn('queue-updateWeather', $job, $data);
    }

    /**
     * Handle the event.
     *
     * @param  UpdateWeatherEvent  $event
     * @return void
     */
    public function handle(UpdateWeatherEvent $event)
    {
        $weather = New Weather;
        return $weather->updateDate($event->location, $event->date, $event->details);
    }
}
