<?php

namespace App\Jobs;

use App\Events\PostComment as EventsPostComment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PostComment implements ShouldQueue
{
    use Queueable,Dispatchable,InteractsWithQueue,SerializesModels;

    /**
     * Create a new job instance.
     */
    public $comment,$user,$count,$time,$id;
    public function __construct($comment,$user,$count,$time,$id)
    {
        $this->comment=$comment;
        $this->user=$user;
        $this->id=$id;
        $this->count=$count;
        $this->time=$time;

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        broadcast(new EventsPostComment($this->comment,$this->user,$this->count,$this->time,$this->id));
    }
}
