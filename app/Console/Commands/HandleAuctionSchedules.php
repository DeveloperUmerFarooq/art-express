<?php
namespace App\Console\Commands;

use App\Events\AuctionEndEvent;
use Illuminate\Console\Command;
use App\Models\Auction;
use App\Mail\AuctionStart;
use App\Mail\WinnerPaymentMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class HandleAuctionSchedules extends Command
{
    protected $signature = 'auctions:handle';
    protected $description = 'Automatically start and end auctions based on time';

    public function handle()
    {
        $now = Carbon::now();

        // END AUCTIONS
        $auctionsToEnd = Auction::where('status','!=','ended')->get();
        if(!empty($auctionsToEnd)){
            foreach ($auctionsToEnd as $auction) {
                $auctionEnd = Carbon::parse($auction->start_date . ' ' . $auction->end_time);
                if ($now->greaterThanOrEqualTo($auctionEnd)) {
                    foreach ($auction->items as $item) {
                        if ($item->winner) {
                            Mail::to($item->winner->email)->send(new WinnerPaymentMail($item, $auction));
                        }
                    }
                    $auction->update(['status' => 'ended']);
                    $this->info("Ended auction ID: {$auction->id}");
                    broadcast(new AuctionEndEvent($auction->id));
                }
            }
        }

        // START AUCTIONS
        $auctionsToStart = Auction::where('status', 'upcoming')->get();
        if(!empty($auctionsToStart)){
            foreach ($auctionsToStart as $auction) {
                $auctionStart = Carbon::parse($auction->start_date . ' ' . $auction->start_time)->addMinutes(5);
                $auctionEnd = Carbon::parse($auction->start_date . ' ' . $auction->end_time);
                if ($now->greaterThanOrEqualTo($auctionStart) && $now->lessThan($auctionEnd)) {
                    $auction->update(['status' => 'ongoing']);
                    foreach ($auction->registeredUsers as $user) {
                        Mail::to($user->email)->send(new AuctionStart($auction, $user));
                    }
                    $this->info("Started auction ID: {$auction->id}");
                }
            }
        }
    }
}
