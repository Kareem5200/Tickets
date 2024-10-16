<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Models\AllMatches;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class userTeam
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $match=AllMatches::findOrFail($request->route('match_id'));

        if($match->tickets()->where('type','=','match')->count()>=$match->stadium->capacity){
            // $match->sold_out= 1;
            $sold_out=1;
         }else{

            //  $match->sold_out= 0;
             $sold_out=0;

         }


            // dd($max_match_time <= now()->timezone('Africa/Cairo')->toTimeString() );

            if($sold_out == 0 && $match->match_date > now()->toDateString()){
                return $next($request);
            }
            else{

                return redirect()->back()->with('Error','You can access unavailable match');

            }



    }
}
