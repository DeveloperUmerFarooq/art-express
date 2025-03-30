<?php

namespace App\Jobs;

use App\Events\LikePost;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class Like implements ShouldQueue
{
    use Queueable,Dispatchable,InteractsWithQueue,SerializesModels;

    /**
     * Create a new job instance.
     */
    public $count,$id;
    public function __construct($count,$id)
    {
        $this->count=$count;
        $this->id=$id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        broadcast(new LikePost($this->count,$this->id));
    }
}
