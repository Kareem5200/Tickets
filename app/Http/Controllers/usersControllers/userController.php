<?php

namespace App\Http\Controllers\usersControllers;

use Carbon\Carbon;

use App\Models\User;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\usersRequests\updateProfileRequest;
use App\Models\DriverTrip;










class userController extends Controller
{


 public function profile()
 {
    $user=User::find(Auth::id());
    return view('users.profile',compact('user'));
 }




 public function update(){

    $user = User::find(Auth::id());
    return view('users.updateProfile',compact('user'));
 }

 public function edit(updateProfileRequest $request)
 {

    $user = User::find(Auth::id());

    $user->update([
            'phone_1'=>$request->phone_1,
    ]);
    return view('users.profile',compact('user'));
 }


public function UpdatePassworfForm(){

    return view('users.changePasswordForm');
}


 public function editPassword(Request $request)
 {

    $user = User::find(Auth::id());



        $request->validate([
            'old_password'=>['required'],
            'password'=>['required','string','min:8','confirmed']
        ]);

        if(Hash::check($request->old_password,Auth::user()->password)){


            $user->update([
                'password'=>Hash::make($request->password),
                ]);

            return redirect()->route('home');
        }else{

            return redirect()->back()->with('oldPasswordWrong','The old password is wrong');
        }

 }




 public function getMatchTickets(){
    $fan_tickets = Ticket::where(['user_id'=>Auth::id(),'type'=>'match','dependent_id'=>null])->get();
    $dependent_tickets = Ticket::where(['user_id'=>Auth::id(),'type'=>'match'])->where('dependent_id','!=',null)->get();
    return view('users.matchTickets',compact('fan_tickets','dependent_tickets'));
 }
 public function getBusTickets(){

    $fan_tickets = Ticket::where(['user_id'=>Auth::id(),'type'=>'bus','dependent_id'=>null])->get();

    foreach($fan_tickets as $ticket){
        $trip = DriverTrip::where(['bus_id'=>$ticket->bus_id,'match_id'=>$ticket->match_id,'trip_date'=>$ticket->match->match_date])->first();
        $ticket->trip_date = $trip->trip_date;
        $ticket->trip_time = $trip->travel_time;
        $ticket->station = $trip->station->location;

    }
    $dependent_tickets = Ticket::where(['user_id'=>Auth::id(),'type'=>'bus'])->where('dependent_id','!=',null)->get();

    foreach($dependent_tickets as $ticket){
        $trip = DriverTrip::where(['bus_id'=>$ticket->bus_id,'match_id'=>$ticket->match_id,'trip_date'=>$ticket->match->match_date])->first();
        $ticket->trip_date = $trip->trip_date;
        $ticket->trip_time = $trip->travel_time;
        $ticket->station = $trip->station->location;

    }

    return view('users.busTickets',compact('fan_tickets','dependent_tickets'));
 }

 public function refundTicket(Ticket $ticket){




    $match_date = $ticket->match->match_date;
    $max_refund_date = Carbon::parse($match_date)->subDays(1);


    if($max_refund_date >= now()->toDateString()){



        if($ticket->type=='bus' && $ticket->status=='Activated'){

            $time = Carbon::parse($ticket->trip->travel_time);
            $time = $time->format('H:i');

            if($ticket->dependent_id==null){
                //Retrun all fan and deps tickets
                $fanTickets = Ticket::where(['user_id'=>$ticket->user_id,'match_id'=>$ticket->match_id,'type'=>'bus','status'=>'Activated'])->get();
                foreach($fanTickets as $ticket){
                    $ticket->update([
                        'status'=>'Refunded',
                        'refund_date'=>now()
                    ]);
                }

            }else{

                //Dep ticket in firestore
                $ticket->update([
                    'status'=>'Refunded',
                    'refund_date'=>now()
                ]);

            }


            return redirect()->route('user.getBusTickets');
        }elseif($ticket->type=='match'&& $ticket->status=='Activated'){


            $time = Carbon::parse($ticket->match->match_time);
            $time=$time->format('H:i:s');



            if($ticket->dependent_id == null && $ticket->user_id ==  Auth::id()){

                $user = User::find($ticket->user_id);
                //In local database
                $allFamilyTickets = $user->tickets()->where(['user_id'=>$ticket->user_id,'match_id'=>$ticket->match_id,'type'=>'match','status'=>'Activated'])->get();
                foreach($allFamilyTickets as $ticket){
                    $ticket->update([
                    'status'=>'Refunded',
                    'refund_date'=>now()
                    ]);

            }


            return redirect()->route('user.getMatchTickets');
        }else{

            return redirect()->back()->with('failed','Your ticket is may be not activated');
        }




    }else{
        return redirect()->back()->with('failed','The maximum time te refund any ticket is before the match or trip by 2 days');
    }




 }




}
}

