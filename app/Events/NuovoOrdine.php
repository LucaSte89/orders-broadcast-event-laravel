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
 
class NuovoOrdine implements ShouldBroadcast
{

    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The order instance.
     *
     * @var \App\Models\Ordini
     */
    public $ordine;


    /**
     * Create a new event instance.
     *
     * @param  \App\Models\Ordini  $user
     * @return void
     */
    public function __construct(Ordini $ordine)
    {
        $this->ordine = $ordine;
    }


    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel
     */
    public function broadcastOn()
    {
        return new Channel('nuovo-ordine');
    }



}