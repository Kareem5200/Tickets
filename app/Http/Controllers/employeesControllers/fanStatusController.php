<?php

namespace App\Http\Controllers\employeesControllers;

use App\Models\User;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use App\Http\Controllers\Controller;
use App\Models\tripPrice;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class fanStatusController extends Controller
{


    public function displayFan(){


            $allUsers=User::get();
            return view('employees.admin.fanStatus',compact('allUsers'));


    }

    public function fanProfile(User $user){

        return view('employees.admin.fanProfile',compact('user'));

    }
    public function getTickets($user_id){

        $allTickets = Ticket::where('user_id','=',$user_id)->get();
        foreach($allTickets as $ticket){
            if($ticket->type=='bus'){
                $price=tripPrice::where(['station_id'=>$ticket->trip->station_id,'stadium_id'=>$ticket->match->stadium_id])->first();
                $ticket->price=$price->seat_price;
            }
        }


        return view('employees.admin.fanTickets',compact('allTickets'));
    }

    public function changeFanStatus(Request $request,User $user){




            if($user->status=="allowed" && $request->status=="panned" && $request->panned_until > now()->toDateString()){

                $user->update([
                    'status'=>$request->status,
                    'panned_date'=>now(),
                    'panned_until'=>$request->panned_until,
                ]);



                return redirect()->route('admin.displayFan');

            }else if($user->status=="panned" &&$request->status=="allowed" && $request->panned_until==null ){
                $user->update([
                    'status'=>$request->status,
                    'panned_date'=>null,
                    'panned_until'=>null,
                ]);
       
                return redirect()->route('admin.displayFan');
                // return Redirect::to(route('admin.displayFan'), 307);


            }else{
                return redirect()->route('admin.displayFan')->with('bannedUntilDateError',"Date error");
            }

    }
}
