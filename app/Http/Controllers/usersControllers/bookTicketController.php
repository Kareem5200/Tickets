<?php

namespace App\Http\Controllers\usersControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bus;
use App\Models\Department;
use App\Models\DriverTrip;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class bookTicketController extends Controller
{
     public static $match_id;
     public static $tickets;


     public function CreateTickets(){


        foreach(self::$tickets as $ticket){
            if($ticket['owner_id']!=null && $ticket['department_id']!=null && $ticket['bus_id']==null){
                //Match
                if($ticket['owner_id'] == Auth::id()){
                    Ticket::create([
                        'match_id'=>self::$match_id,
                        'user_id'=>Auth::id(),
                        'buy_date'=>now(),
                        'department_id'=>$ticket['department_id'],
                    ]);

                }else{
                    Ticket::create([
                        'match_id'=>self::$match_id,
                        'user_id'=>Auth::id(),
                        'dependent_id'=>$ticket['owner_id'] ,
                        'buy_date'=>now(),
                        'department_id'=>$ticket['department_id'],
                    ]);
                }

            }else{
                //Bus
                if($ticket['owner_id'] == Auth::id()){
                    Ticket::create([
                        'match_id'=>self::$match_id,
                        'type'=>'bus',
                        'user_id'=>Auth::id(),
                        'buy_date'=>now(),
                        'dependent_id'=>null,
                        'bus_id'=>$ticket['bus_id']
                    ]);

                }else{
                    Ticket::create([
                        'match_id'=>self::$match_id,
                        'type'=>'bus',
                        'user_id'=>Auth::id(),
                        'buy_date'=>now(),
                        'dependent_id'=>$ticket['owner_id'],
                        'bus_id'=>$ticket['bus_id']

                    ]);
                }


            }

        }
        return redirect()->route('user.profile',Auth::id());
    }



    function bookMatchTicket($match_id,$ticket){


            if($ticket['owner_id'] == Auth::id()){

                $fan_Ticket_exist = Ticket::where(['match_id'=>$match_id,'type'=>'match','status'=>'active',
                'user_id'=>$ticket['owner_id'],'dependent_id'=>null])->exists(); // check if fan jas ticket or not

                // dd($fan_Ticket_exist);

                if(!$fan_Ticket_exist){


                       Ticket::create([
                            'match_id'=>$match_id,
                            'user_id'=>Auth::id(),
                            'buy_date'=>now(),
                            'department_id'=>$ticket['department_id'],
                        ]);




                        return true;
                }else{

                    return false;


                }

            }else{

                $dependent_Ticket_exist = Ticket::where(['match_id'=>$match_id,'type'=>'match','status'=>'active',
                'user_id'=>Auth::id(),'dependent_id'=>$ticket['owner_id']])->exists();// check if dependent jas ticket or not

                if(!$dependent_Ticket_exist){

                        Ticket::create([
                            'match_id'=>$match_id,
                            'user_id'=>Auth::id(),
                            'dependent_id'=>$ticket['owner_id'] ,
                            'buy_date'=>now(),
                            'department_id'=>$ticket['department_id'],
                        ]);

                        return true;
                }else{

                    return false;


                }










        }


    }

    function bookBustTicket($match_id,$ticket){

        if($ticket['owner_id'] == Auth::id()){
            $fan_Ticket_exist = Ticket::where(['match_id'=>$match_id,'type'=>'bus','status'=>'active',
            'user_id'=>$ticket['owner_id'],'dependent_id'=>null])->exists(); // check if fan jas ticket or not

            if(!$fan_Ticket_exist){
                Ticket::create([

                    'match_id'=>$match_id,
                    'type'=>'bus',
                    'user_id'=>Auth::id(),
                    'buy_date'=>now(),
                    'dependent_id'=>null,
                    'bus_id'=>$ticket['bus_id']


            ]);


            }else{

                return redirect()->back()->with('fanBusTicketError','Fan ticket of bus already exists');

            }

        }else{

            $dependent_Ticket_exist = Ticket::where(['match_id'=>$match_id,'type'=>'bus','status'=>'active',
            'user_id'=>Auth::id(),'dependent_id'=>$ticket['owner_id']])->exists();// check if dependent jas ticket or not

            if(!$dependent_Ticket_exist ){
                Ticket::create([

                    'match_id'=>$match_id,
                    'type'=>'bus',
                    'user_id'=>Auth::id(),
                    'buy_date'=>now(),
                    'dependent_id'=>$ticket['owner_id'],
                    'bus_id'=>$ticket['bus_id']


            ]);


            }else{
                return redirect()->back()->with('depBusTicketError','Fan ticket of bus already exists');

            }

        }
    }




    function availableBusTickets($match_id,$ticket){
        $bus = Bus::find($ticket['bus_id']);
        $total_tickets = Ticket::where(['match_id'=>$match_id,'bus_id'=>$ticket['bus_id']])->count();
        $availableTickets = $bus->seats - $total_tickets;
        return  $availableTickets;
    }
    function availableMatchTickets($match_id,$ticket){
        $department = Department::find($ticket['department_id']);
        $numbers_of_tickets_in_department =$department->tickets()->where(['match_id'=>$match_id,'status'=>'active'])->count();
        $available = $department->capacity -$numbers_of_tickets_in_department;

        return $available;
    }



    public function bookTicket(Request $request,$match_id){
            $tickets=[];
            $iteration = 0;

            foreach($request->ticket as $ticket){
                if($ticket['owner_id']!= null && ($ticket['bus_id'] != null || $ticket['department_id']!= null)){
                    array_push($tickets,$ticket);
                }
            }


           foreach($tickets as $ticket){
              $iteration++;

              $bus = Bus::find($ticket['bus_id']);
              $department = Department::find($ticket['department_id']);



               if($ticket['owner_id']!= null && $ticket['department_id']!= null && $ticket['bus_id'] == null){

                //Match ticket only

                $available = $this->availableMatchTickets($match_id,$ticket);

                if($available >= 1 ){

                    $status = $this->bookMatchTicket($match_id,$ticket);

                    if( !$status ){

                        return redirect()->back()->with('fanTicketError','Fan ticket of match already exists some tickets not booked please check the tickets');

                    }

                }else{

                    $fullCapacityError = 'Start from match ticket number ' . $iteration . ' not booked due to department ' . $department->name . ' full capacity';
                    return redirect()->back()->with('fullCapacityError', $fullCapacityError);
                }




               }elseif($ticket['owner_id']!= null && $ticket['department_id']== null && $ticket['bus_id'] != null){

                    //  Bus ticket only

                    $availableTickets = $this->availableBusTickets($match_id,$ticket);



                    if($availableTickets>=1){

                        $status = $this->bookBustTicket($match_id,$ticket);
                         if( !$status ){

                            return redirect()->back()->with('fanBusTicketError','Fan ticket of bus already exists some tickets not booked please check the tickets');

                        }


                    }else{

                        $fullBusError = 'Start from match ticket number ' . $iteration . ' not booked due to bus  ' . $bus->bus_number . ' full capacity';
                        return redirect()->back()->with('fullBusError', $fullBusError);

                    }




               }elseif($ticket['owner_id']!= null && $ticket['department_id']!= null && $ticket['bus_id'] != null){
                //Both match and bus
                $availableBusTickets = $this->availableBusTickets($match_id,$ticket);
                $availableMatchTickets = $this->availableMatchTickets($match_id,$ticket);


                if($availableBusTickets >=1 && $availableMatchTickets >=1){

                    $match_status =  $this->bookMatchTicket($match_id,$ticket);
                    $bus_status =  $this->bookBustTicket($match_id,$ticket);

                    if(!$match_status && !$bus_status){

                        return redirect()->back()->with('fanBusTicketError','one of two tickets already exists so some tickets not booked please check the tickets');

                    }

                }else{
                    $fullBusError = 'Start from match ticket number ' . $iteration . ' not booked due to bus  ' . $bus->bus_number . 'or'. $department->name. ' full capacity';
                    return redirect()->back()->with('fullBusError', $fullBusError);
                }


               }else{

                return redirect()->back()->with('fillError','Please fill fields of one ticket at least');
               }
           }

            return redirect()->route('matches');



         }






















}
