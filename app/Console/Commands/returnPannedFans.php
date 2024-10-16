<?php

namespace App\Console\Commands;

use App\Models\User;
use Kreait\Firebase\Factory;
use Illuminate\Console\Command;

class returnPannedFans extends Command
{


    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:return-panned-fans';

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
        $pannedUsers=User::where("status","=","panned")->get();

        foreach($pannedUsers as $pannedUser){

            if($pannedUser->panned_until<= now()->toDateString() && $pannedUser->panned_date!==null){
                // dd("done");
                $pannedUser->update([
                    'status'=>"allowed",
                    'panned_date'=>null,
                    'panned_until'=>null,
                ]);
            }
        }
    }


}
