<?php
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class AuctionEnded implements ShouldBroadcastNow
{
    use InteractsWithSockets, SerializesModels;

    public $auctionId;
    public $message;

    public function __construct($auctionId, $message = 'The auction has ended!')
    {
        $this->auctionId = $auctionId;
        $this->message = $message;
    }

    public function broadcastOn(): Channel
    {
        return new Channel('auction.' . $this->auctionId);
    }

    public function broadcastWith()
    {
        return [
            'auctionId' => $this->auctionId,
            'message' => $this->message
        ];
    }

    public function broadcastAs()
    {
        return 'AuctionEnded';
    }
}
