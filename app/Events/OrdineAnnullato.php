<?php

namespace App\Events;

use App\Models\Ordini;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class OrdineAnnullato implements ShouldBroadcast
{

    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The order instance.
     *
     * @var \App\Models\Ordini
     */
    public $numeroOrdine;


    /**
     * Create a new event instance.
     *
     * @param  int $numeroOrdine
     * @return void
     */
    public function __construct($numeroOrdine)
    {
        $this->numeroOrdine = $numeroOrdine;
    }


    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel
     */
    public function broadcastOn()
    {
        return new Channel('ordini');
    }



}
