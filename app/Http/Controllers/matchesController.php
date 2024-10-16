<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Team;
use App\Models\Ticket;
use App\Models\Stadium;
use App\Models\Dependent;
use App\Models\tripPrice;
use App\Models\AllMatches;
use App\Models\Department;
use App\Models\DriverTrip;
use App\Models\Competition;
use App\Models\MatchTickets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class matchesController extends Controller
{

    public function index(){

        $matches = AllMatches::whereBetween('match_date',[now()->tomorrow(),now()->addDays(15)])->get();

        $matches = $matches->reject(function($match){
           return $match->tickets()->where('type','=','match')->count()>=$match->stadium->capacity;

        });


        foreach($matches as $match){
            $matchDate=Carbon::parse($match->match_date);
            $match->match_date=$matchDate->format('Y-M-d');
    }

        return view('matches',compact('matches'));
    }



   public function displayBookMatch($match_id){

    $match = AllMatches::find($match_id);

        $match_date= Carbon::parse($match->match_date);
        $match->$match_date =  $match_date->format('Y-m-d');

        $dependents = Dependent::where(["user_id"=>Auth::id(),'status'=>'allowed'])->get();
        $departments = Department::where('stadium_id','=',$match->stadium->id)->get();
        $match_trips = DriverTrip::where('match_id','=',$match_id)->get();



        $dependents_has_no_match_ticket=[];
        $available_departments=[];
        $available_trips=[];
        // $prices_array=[];


        foreach($match_trips  as $trip){

            $number_bus_tickets = Ticket::where(['match_id'=>$match_id,'status'=>'Activated','type'=>'bus','bus_id'=>$trip->bus->id])->count();
            $prices = tripPrice::where(['stadium_id'=>$trip->match->stadium->id,'station_id'=>$trip->station_id])->first();

            // array_push($prices_array,$prices);
            if($number_bus_tickets < $trip->bus->seats){
                $trip->empty_seats =  $trip->bus->seats - $number_bus_tickets ;
                $trip->price =$prices->seat_price;
                array_push($available_trips,$trip);
            }



        }
        $available_trips=(object)$available_trips;
        //  dd($available_trips);





        foreach($dependents as $dependent){
            $dependent_match_ticket_exist = $dependent->tickets()->where(['match_id'=>$match_id,'status'=>'Activated','type'=>'match'])->first();
            $dependent_bus_ticket_exist = $dependent->tickets()->where(['match_id'=>$match_id,'status'=>'Activated','type'=>'bus'])->first();


            if(!$dependent_match_ticket_exist || !$dependent_bus_ticket_exist){
                array_push($dependents_has_no_match_ticket,$dependent);
            }


        }



       foreach($departments as $department){


        $numbers_of_tickets_in_department =$department->tickets()->where(['match_id'=>$match_id,'status'=>'Activated'])->count();




        if($numbers_of_tickets_in_department < $department->capacity){
            $department->available = $department->capacity -$numbers_of_tickets_in_department;
            array_push($available_departments,$department);
        }

       }



        return view('bookMatches',compact('match','dependents_has_no_match_ticket','available_departments','available_trips'));
    }

}






