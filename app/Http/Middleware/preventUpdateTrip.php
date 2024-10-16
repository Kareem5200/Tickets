<?php

namespace App\Http\Middleware;

use App\Models\DriverTrip;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class preventUpdateTrip
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $match = $request->route('match');
        $driver = $request->route('driver');
        $travelTime = $request->route('time');
        $tripExists = DriverTrip::where(['match_id'=>$match->id,'driver_id'=>$driver->id,'travel_time'=> $travelTime])->first();

        if($match->match_date>=now() && $tripExists && $driver!=null && $match!=null ){
            return $next($request);
        }else{
            return redirect()->route('admin.displayTrips')->with('Error','You cannot update this trip');
        }



    }
}
