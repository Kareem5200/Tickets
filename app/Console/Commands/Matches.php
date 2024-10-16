<?php

namespace App\Console\Commands;

use App\Models\AllMatches;
use App\Models\Competition;
use App\Models\Team;
use App\Models\Stadium;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class Matches extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:matches';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'store matches';

    /**
     * Execute the console command.
     */

    function createMatches($matches){
        foreach($matches as $match){
            $competition=Competition::where(["name"=>$match["league_name"],'country'=>$match["country_name"]])->first();
            $homeTeam = Team::where("name","=",$match["event_home_team"])->first();
            $awayTeam = Team::where("name","=",$match["event_away_team"])->first();
            $stadium = Stadium::where("name","=",$match["event_stadium"])->first();

            if($competition!=null && $stadium!=null && $homeTeam!=null && $awayTeam!=null){

                $row = AllMatches::where(['match_date'=>$match['event_date'],
                'match_time'=>$match['event_time'],
                'stadium_id'=>$stadium->id
                ])->exists();


                if(!$row){
                    // dd($stadium->id);
                    $match =AllMatches::create([
                        'stadium_id'=>$stadium->id,
                        'competition_id'=>$competition->id,
                        'match_date'=>$match['event_date'],
                        'match_time'=>$match['event_time'],
                    ]);

                     $teams=[$homeTeam->id,$awayTeam->id];
                     $match->teams()->attach($teams);

                }
            }
         }
    }

    public function handle()
    {



        $from=now()->tomorrow();
        $to=now()->addDays(15);

        $response=Http::get("https://apiv2.allsportsapi.com/football/?met=Fixtures&APIkey=a2caf06e5dd7ddb7b729d15dd2c9c18a2402846bf69eb747c629f5e1eb0da996&from=$from&to=$to&leagueId=141");
        $jsonResponse=$response->json();
        $matches =$jsonResponse['result'];
        $this->createMatches($matches);

        $response2=Http::get("https://apiv2.allsportsapi.com/football/?met=Fixtures&APIkey=a2caf06e5dd7ddb7b729d15dd2c9c18a2402846bf69eb747c629f5e1eb0da996&from=$from&to=$to&leagueId=1");
        $jsonResponse2=$response2->json();
        $euroMatches =$jsonResponse2['result'];
        $this->createMatches($euroMatches);

        $response3=Http::get("https://apiv2.allsportsapi.com/football/?met=Fixtures&APIkey=a2caf06e5dd7ddb7b729d15dd2c9c18a2402846bf69eb747c629f5e1eb0da996&from=$from&to=$to&leagueId=17");
        $jsonResponse3=$response3->json();
        $copaMatches =$jsonResponse3['result'];
        $this->createMatches($copaMatches);






    }

}
