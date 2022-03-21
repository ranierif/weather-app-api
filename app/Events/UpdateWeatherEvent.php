<?php

namespace App\Events;

use App\Models\Location;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UpdateWeatherEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $location;
    public $date;
    public $details;

    /**
     * Create a new job instance.
     *
     * @param Location $location
     * @param $date
     * @param $details
     *
     * @return void
     */
    public function __construct(Location $location, $date, $details)
    {
        $this->location = $location;
        $this->date = $date;
        $this->details = $details;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-update-weather-data' );
    }
}
