<?php

namespace App\Console\Commands;

use App\Models\Ticket;
use Illuminate\Console\Command;

class updateActiveTickets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-active-tickets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $activeTickets = Ticket::where('status','=','Activated')->get();
        foreach($activeTickets as $ticket){
            // dd($ticket->match->match_date);
            if($ticket->match->match_date <= now()->toDateString() && $ticket->match->match_time <= now()->setTimezone('Africa/Cairo')->addHours(3)->toTimeString()){
                $ticket->update([
                    'status'=>'Expired'
                ]);
            }
        }
    }
}
