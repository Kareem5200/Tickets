<?php

namespace App\Http\Controllers\employeesControllers;

use Carbon\Carbon;
use App\Models\Bus;
use App\Models\Ticket;
use App\Models\Station;
use App\Models\Employee;
use App\Models\tripPrice;
use App\Models\AllMatches;
use App\Models\DriverTrip;
use App\Http\Controllers\Controller;
use App\Http\Requests\updateTripRequest;
use App\Http\Requests\employeesRequests\addTripRequest;
use App\Http\Requests\employeesRequests\getEmployeeRequest;

class tripsController extends Controller
{


    public function displayTrips(){

        $tripsOfThisMonth=DriverTrip::get();
        return view('employees.admin.displayTrips',compact('tripsOfThisMonth'));
    }


    public function addTripForm(){


            $buses=Bus::where('status','=','active')->get();
            // $stadiums=Stadium::get();
            $matches = AllMatches::where('match_date','>=',now()->addDay()->toDateString())->get();
            $matches = $matches->reject(function ($match) {
                return $match->competition ->country!='Egypt';
            });
            $stations=Station::where('status','=','active')->get();
            $drivers=Employee::where(['type'=>'driver','status'=>'active'])->get();

            return view('employees.admin.addTrip',compact('buses','matches','stations','drivers'));

    }




    public function addTrip(addTripRequest $request){

        // dd($request->all());

            $match=AllMatches::find($request->match_id);
            $maxTripTime = carbon::parse($match->match_time)->subHours(3)->toTimeString();

            $tripExist1=DriverTrip::where(['match_id'=> $request->match_id,'driver_id'=>$request->driver_id])
            ->exists();

            $tripExist2=DriverTrip::where(['match_id'=> $request->match_id,'bus_id'=>$request->bus_id])
            ->exists();

            $tripExist3=DriverTrip::where(['driver_id'=>$request->driver_id,'trip_date'=>$match->match_date])
            ->exists();

            $busTrip=DriverTrip::where(['trip_date'=>$match->match_date,'bus_id'=>$request->bus_id])
            ->first();


            if($busTrip !=null){
                $timeBeforeTripBy2Hours = Carbon::parse($busTrip->travel_time)->subHours(2)->toTimeString();
                $timeAfterTripBy2Hours = Carbon::parse($busTrip->travel_time)->addHours(2)->toTimeString();
                if($request->travel_time > $timeBeforeTripBy2Hours && $request->travel_time < $timeAfterTripBy2Hours){
                    return redirect()->back()->with('duplicated_key','The bus has trip plus or minus 2 hours from this travel time');
                }
            }


            if($request->travel_time >= $maxTripTime ){
                return redirect()->back()->with('duplicated_key','The travel time must atleast before match by 3 hours');
            }








          if($tripExist1 ||$tripExist2 ||$tripExist3){
            return redirect()->back()->with('duplicated_key','This trip already exists or this driver has trip in this day');
          }else{
            $prices = tripPrice::where(['stadium_id'=>$match->stadium->id,'station_id'=>$request->station_id])->first();

                if($prices!=null){

                    // $time = Carbon::createFromFormat('H:i:s',$request->travel_time);
                    // $formattedTime = $time->format('H:i:s');




                    if($request->travel_time < $match->match_time){
                        DriverTrip::create([
                            'match_id'=> $request->match_id,
                            'station_id'=> $request->station_id,
                            'bus_id'=>$request->bus_id,
                            'driver_id'=>$request->driver_id,
                            'trip_date'=>$match->match_date,
                            'travel_time'=>$request->travel_time,

                        ]);
                        return redirect()->route('admin.displayTrips');
                    }else{

                        return redirect()->back()->with('travelTimeError','trip time must be less than match time');

                    }
                }else{
                    return redirect()->back()->with('travelTimeError','Check the prices of this trip it may be null');
                }


          }





    }


    public function updateTripForm(Employee $driver ,AllMatches $match,$time,$station_id){


            $trip=DriverTrip::where(["driver_id"=>$driver->id,"trip_date"=>$match->match_date])->first();
            $buses=Bus::where('status','=','active')->get();
            // $stadiums=Stadium::get();
            $matches = AllMatches::get();
            // $stations=Station::where('status','=','active')->get();
            $drivers=Employee::where(['type'=>'driver','status'=>'active'])->get();
            return view('employees.admin.updateTrip',compact('trip','buses','matches','drivers','time','station_id'));


    }

    public function editTrip(updateTripRequest $request,Employee $driver ,AllMatches $match,$time){
        $localTrip = DriverTrip::where(["driver_id"=>$driver->id,"trip_date"=>$match->match_date])->first();
        $tickets = Ticket::where(['bus_id'=>$localTrip->bus_id,'status'=>'Activated','match_id'=>$match->id])->get();

        $time=Carbon::parse($request->travel_time)->format('H:i:s');
        $maxTripTime =  Carbon::parse($match->match_time)->subHours(3)->format('H:i:s');

        if($time <= $maxTripTime){

                $DriverTrips = DriverTrip::where('bus_id','=',$request->bus_id)->exists();

                if($DriverTrips){

                    DriverTrip::where(["driver_id"=>$driver->id,"trip_date"=>$match->match_date])->update([
                        'driver_id'=>$request->driver_id,
                        // 'station_id'=>$request->station_id,
                        'bus_id'=>$request->bus_id,
                        'travel_time'=>$request->travel_time,

                    ]);
                }else{
                    return redirect()->back()->with('Error','Sorry select any bus make at least one trip');

                }



              if($tickets!=null &&  $localTrip->bus_id != $request->bus_id){

                    foreach($tickets as $ticket){

                        $ticket->update([
                            'bus_id'=>$request->bus_id,
                        ]);
                    }
                }
        return redirect()->route('admin.displayTrips');
    }else{

        return redirect()->back()->with('Error','trip time must be less than match time by 3 hours minimum');
    }



    }




    public function displayEmployeeTrips(){

        $drivers=Employee::where('type','=','driver')->get();
        $trips=null;
        return view('employees.admin.employeeTrip',compact('drivers','trips'));

    }

    public function  getEmployeeTrips(getEmployeeRequest $request){

        $drivers=Employee::where('type','=','driver')->get();
        $prices_array=[];
        if($request->year <= now()->year && $request->month <= now()->month && $request->driver_id==null){

                // dd('ok date');
                $trips=DriverTrip::whereYear('trip_date',$request->year)
                ->whereMonth('trip_date',$request->month)
                ->get();
                foreach($trips as $trip){

                    $prices = tripPrice::where(['stadium_id'=>$trip->match->stadium->id,'station_id'=>$trip->station_id])->first();
                    array_push($prices_array,$prices);
                    // dd($prices->station_id);
                }
                return view('employees.admin.employeeTrip',compact('trips','drivers','prices_array'));
        }else if($request->year != null && $request->month != null && $request->driver_id!==null){
                // dd('ok all');
                $trips=DriverTrip::where("driver_id","=",$request->driver_id)
                ->whereYear('trip_date',$request->year)
                ->whereMonth('trip_date',$request->month)
                ->get();
                foreach($trips as $trip){
                    $prices = tripPrice::where(['stadium_id'=>$trip->match->stadium->id,'station_id'=>$trip->station_id])->first();
                    array_push($prices_array,$prices);
                    // dd($prices->station_id);
                }
                return view('employees.admin.employeeTrip',compact('trips','drivers','prices_array'));


        }else if($request->year == null && $request->month == null && $request->driver_id!==null){
            $trips=DriverTrip::where("driver_id","=",$request->driver_id)->get();
            foreach($trips as $trip){
                // dd($trip);
                $prices = tripPrice::where(['stadium_id'=>$trip->match->stadium->id,'station_id'=>$trip->station_id])->first();
                array_push($prices_array,$prices);
                // dd($prices->station_id);
            }
            return view('employees.admin.employeeTrip',compact('trips','drivers','prices_array'));

        }else{
            return redirect()->back()->with('invalidDate','Invalid date');
        }




    }
}
