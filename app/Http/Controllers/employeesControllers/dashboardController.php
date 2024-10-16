<?php

namespace App\Http\Controllers\employeesControllers;

use App\Models\Bus;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DriverTrip;
use App\Models\Maintenance;
use App\Models\Ticket;
use App\Models\tripPrice;
use Illuminate\Support\Facades\Gate;

class dashboardController extends Controller
{
    public function index(){

        $income=0;
        $driver_salaries=0;
        $maintenance_price=0;


        $users=User::get()->count();
        $employees=Employee::where('status','=','active')->get()->count();
        $buses=Bus::where('status','=','active')->get()->count();
        $match_tickets = Ticket::where(['type'=>'match'])->whereIn('status',['Activated','Expired'])->whereMonth('buy_date',now()->month)->count();
        $bus_tickets = Ticket::where(['type'=>'bus'])->whereIn('status',['Activated','Expired'])->whereMonth('buy_date',now()->month)->count();
        $tickets = Ticket::whereMonth('buy_date',now()->month)->get();
        // dd($tickets);
        $trips = DriverTrip::whereMonth('trip_date',now()->month)->get();
        $bus_maintenances = Maintenance::whereMonth('maintenance_date',now()->month)->get();

        foreach($trips as $trip){
            $price = tripPrice::select('trip_price')->where(['station_id'=>$trip->station_id,'stadium_id'=>$trip->match->stadium_id])->first();
            $driver_salaries = $driver_salaries + $price->trip_price ;
        }
        foreach($bus_maintenances as $maintenance){

            $maintenance_price = $maintenance_price +  $maintenance->maintenance_price;

        }

        $outcome = $maintenance_price + $driver_salaries;




        foreach($tickets as $ticket){

            if($ticket->status !="Refunded"){
                if($ticket->type=='match'){
                    $income = $income + $ticket->department->price;
                }elseif($ticket->type=='bus'){
                    $trip = DriverTrip::where(['match_id'=>$ticket->match_id,'bus_id'=>$ticket->bus_id])->first();
                    $price = tripPrice::select('seat_price')->where(['station_id'=>$trip->station_id,'stadium_id'=>$trip->match->stadium_id])->first();
                    $income = $income + $price->seat_price;

                }
            }elseif($ticket->status =="Refunded"){
                if($ticket->type=='match'){
                    $income = $income + ($ticket->department->price * 0.1);
                }elseif($ticket->type=='bus'){
                    $trip = DriverTrip::where(['match_id'=>$ticket->match_id,'bus_id'=>$ticket->bus_id])->first();
                    $price = tripPrice::select('seat_price')->where(['station_id'=>$trip->station_id,'stadium_id'=>$trip->match->stadium_id])->first();
                    $income = $income + ($price->seat_price * 0.1);

                }

            }


         }






            return View('employees.admin.dashboard',compact('users','employees','buses','match_tickets','bus_tickets','income','outcome'));
    }
}
