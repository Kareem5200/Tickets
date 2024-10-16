<?php

namespace App\Http\Controllers\employeesControllers;

use App\Models\Bus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\employeesRequests\busRequest;
use App\Http\Requests\employeesRequests\maintenanceRequest;
use App\Models\DriverTrip;

class manageBusController extends Controller
{
    public function displayBuses(){

                $allBuses=Bus::where('status','=','active')->get();
                return view('employees.admin.buses',compact('allBuses'));


    }
    public function addBusForm(){

        return view('employees.admin.addBus');
    }

    public function addBus(busRequest $request){
        $bus = Bus::where('bus_number','=',$request->bus_number)->exists();

        if($bus){
            return redirect()->back()->with('Error','This bus already exists');


        }else{

            Bus::create([
                'seats'=>$request->seats,
                'bus_number'=>$request->bus_number,
            ]);
            return redirect()->route('admin.displayBuses');
        }

    }
    public function deleteBus(Bus $bus){


        $busTrips = DriverTrip::where('bus_id','=',$bus->id)->where('trip_date','>=',now())->exists();

        if($busTrips){

            return redirect()->back()->with('error','This bus has trips must change the bus of this trips');
        }else{
            $bus->update([
                'status'=>'deactive'
            ]);
            return redirect()->route('admin.displayBuses');
        }






    }

    public function displayBusMaintenance(Bus $bus){

        if($bus->status=='active'){
            $maintenances=$bus->maintenances;
            return view('employees.admin.maintenance',compact('maintenances','bus'));
        }

    }

    public function addMaintenanceForm(Bus $bus){
        if( $bus->status=='active'){
            return view('employees.admin.addMaintenance',compact('bus'));
        }


    }

    public function addMaintenance(maintenanceRequest $request,Bus $bus){

        if($bus->status=='active'){

            $maxDate=now()->subDays(7)->toDateString();
            if($request->maintenance_date >= $maxDate && $request->maintenance_date <= now()->toDateString() ){


                $bus->maintenances()->create([
                    'maintenance_descrption'=>$request->maintenance_description,
                    'maintenance_price'=>$request->maintenance_price,
                    'maintenance_date'=>$request->maintenance_date,
                ]);
                return redirect()->route('admin.displayBusMaintenance',$bus);

            }else{

                return redirect()->back()->with('errorDate','Maintenance date must be in last week or today as maximum day');

            }


        }


    }


}
