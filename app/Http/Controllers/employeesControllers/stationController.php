<?php

namespace App\Http\Controllers\employeesControllers;

use App\Models\Station;
use App\Models\DriverTrip;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\employeesRequests\StationRequest;

class stationController extends Controller
{
    public function displayStations(){

            $stations=Station::where('status','=','active')->get();
            return view('employees.admin.displayStations',compact('stations'));

    }

    public function deleteStation(Station $station){

        $stationTrips = DriverTrip::where('station_id','=',$station->id)->where('trip_date','>=',now())->exists();

        if($stationTrips){

            return redirect()->back()->with('error','This station has trips must change the station of this trips');
        }else{

            $station->update([
                'status'=>'deactive',
            ]);

            return redirect()->route('admin.displayStations');

        }

    }

    public function addStationForm(){

        return view('employees.admin.addStation');
    }

    public function addStation(StationRequest $request){
        Station::create([
            'location'=>$request->station_location,
        ]);
        return redirect()->route('admin.displayStations');

        // $station = Station::where('location','=',$request->station_location)->exists();
        // if($station){

        //     return redirect()->back()->with('Error','This station already exists');

        //    }else{
        //    }

    }



}
