<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\Ticket;
use App\Models\Dependent;
use App\Models\Department;
use PayMob\Facades\PayMob;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Session\Session;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Controllers\usersControllers\bookTicketController;
use App\Models\AllMatches;
use App\Models\DriverTrip;
use Carbon\Carbon;

class paymobController extends Controller
{

    public $response;
    public $match_id;
    public $tickets;
    public $total_price;






    public function credit($match_id,Request $request){
        $tickets=[];
        $bookedDepartment=[];
        $bookedBus=[];
        $unbookedDepartment=[];
        $unbookedBus=[];
        $ParentMatchTicket=0;
        $ParentBusTicket=0;
        $fanMatchticket= 0;
        $fanBusTicket=0;
        $depsMatchTickets=[];
        $depsBusTickets=[];

        $match = AllMatches::find($match_id);


        $factory = (new Factory)
        ->withServiceAccount('C:\xampp\htdocs\Fanzone_project\storage\fanzone2.json')
        ->withDatabaseUri('https://console.firebase.google.com/project/fanzone-5210f/firestore/databases/-default-/data/~2F')
        ->withProjectId('fanzone-5210f');

         $firestore = $factory->createFirestore();
         $auth = $factory->createAuth();


        ////////////////////// Filter the request/////////////////////////
        foreach($request->ticket as $ticket){
            if($ticket['owner_id']!= null && ($ticket['bus_id'] != null || $ticket['department_id']!= null)){
                array_push($tickets,$ticket);
            }
        }

        ////////////////////// Validation on each ticket /////////////////////////
        if(empty($tickets)){

            return redirect()->route('displayBookMatch',$match_id)->with('Error','Sorry you can book atleast one match ticket or one bus ticket');

        }






        foreach($tickets as $ticket){


            if($ticket['owner_id']!=null && $ticket['department_id']!=null && $ticket['bus_id']==null){
                //Validation on When ticket is Match ticket



                if($ticket['owner_id'] == Auth::id()){
                    //Fan ticket
                    $fanMatchticket++;
                    if($fanMatchticket > 1){
                        return redirect()->route('displayBookMatch',$match_id)->with('Error','Error in booking you want to book two tickets for same fan');
                    }

                    $ticket_exists = Ticket::where(['match_id'=>$match_id,'type'=>'match','status'=>'Activated',
                    'user_id'=>$ticket['owner_id'],'dependent_id'=>null])->exists();
                    if($ticket_exists){

                        return redirect()->route('displayBookMatch',$match_id)->with('Error','Fan ticket already exists sorry all tickets not booked');

                    }else{

                        $department = Department::find($ticket['department_id']);
                        $bookedTickets = Ticket::where(['match_id'=>$match_id,'status'=>'Activated','type'=>'match','department_id'=>$department->id])->count();
                        $capacity =  $department->capacity;
                        $availableTickets = $capacity - $bookedTickets;

                        if($availableTickets == 1){

                           $full_capacity =  in_array($department->name,$bookedDepartment);
                           if($full_capacity){

                                return redirect()->route('displayBookMatch',$match_id)->with('Error','one of choosen department cannot contain this number of tickets so all tickets not boooked');

                           }else{
                                array_push($bookedDepartment,$department->name);
                                $ParentMatchTicket++;
                                continue;
                           }


                        }elseif($availableTickets > 1 ){
                            $ParentMatchTicket++;
                            if(array_key_exists($department->name,$unbookedDepartment)){

                                $unbookedDepartment[$department->name]--;

                            }else{
                                $unbookedDepartment[$department->name]=$availableTickets-1;

                            }
                            if($unbookedDepartment[$department->name]< 0){
                                return redirect()->route('displayBookMatch',$match_id)->with('Error','one of choosen department cannot contain this number of tickets so all tickets not boooked');

                            }else{

                                continue;
                            }



                       }else{

                        return redirect()->route('displayBookMatch',$match_id)->with('Error','one of choosen department cannot contain this number of tickets so all tickets not boooked');

                       }




                    }


                }else{
                    //Check if select two tickets for same dependent
                    if(in_array($ticket['owner_id'],$depsMatchTickets)){

                        return redirect()->route('displayBookMatch',$match_id)->with('Error','Error in booking you want to book two match tickets for same dependent');
                    }else{
                        array_push($depsMatchTickets,$ticket['owner_id']);
                    }

                    //Dependent Ticket
                    $ticket_exists = Ticket::where(['match_id'=>$match_id,'type'=>'match','status'=>'Activated',
                    'user_id'=>Auth::id(),'dependent_id'=>$ticket['owner_id']])->exists();

                    $parent_ticket_exists = Ticket::where(['match_id'=>$match_id,'type'=>'match','status'=>'Activated',
                    'user_id'=>Auth::id(),'dependent_id'=>null])->exists();

                    // dd($parent_ticket_exists);

                    if($ticket_exists){

                        return redirect()->route('displayBookMatch',$match_id)->with('Error','One of dependents ticket already exists  sorry all tickets not booked');


                    }else{
                        if($ParentMatchTicket==1 || $parent_ticket_exists){
                            $department = Department::find($ticket['department_id']);
                            $bookedTickets = Ticket::where(['match_id'=>$match_id,'status'=>'Activated','type'=>'match','department_id'=>$department->id])->count();
                            $capacity =  $department->capacity;
                            $availableTickets = $capacity - $bookedTickets;

                            if($availableTickets == 1){

                               $full_capacity =  in_array($department->name,$bookedDepartment);
                               if($full_capacity){

                                    return redirect()->route('displayBookMatch',$match_id)->with('Error','one of choosen department cannot contain this number of tickets so all tickets not boooked');

                               }else{
                                    array_push($bookedDepartment,$department->name);
                                    continue;
                               }


                            }elseif($availableTickets > 1 ){
                                if(array_key_exists($department->name,$unbookedDepartment)){

                                    $unbookedDepartment[$department->name]--;
                                }else{
                                    $unbookedDepartment[$department->name]=$availableTickets-1;


                                }
                                if($unbookedDepartment[$department->name]< 0){
                                    return redirect()->route('displayBookMatch',$match_id)->with('Error','one of choosen department cannot contain this number of tickets so all tickets not boooked');

                                }else{

                                    continue;
                                }


                           }

                        }else{

                            return redirect()->route('displayBookMatch',$match_id)->with('Error','Parent not have match ticket');

                        }



                    }



                }
            }elseif($ticket['owner_id']!=null && $ticket['department_id']==null && $ticket['bus_id']!=null){
                //Bus ticket
                if($ticket['owner_id'] == Auth::id()){

                    $fanBusTicket++;
                    if($fanBusTicket > 1){
                        return redirect()->route('displayBookMatch',$match_id)->with('Error','Error in booking you want to book two tickets for same fan');
                    }

                    $ticket_exists = Ticket::where(['match_id'=>$match_id,'type'=>'bus','status'=>'Activated',
                    'user_id'=>$ticket['owner_id'],'dependent_id'=>null])->exists();


                    if($ticket_exists){

                        return redirect()->route('displayBookMatch',$match_id)->with('Error','Fan ticket already exists sorry all tickets not booked');

                    }else{


                        $bus = Bus::find($ticket['bus_id']);
                        $bookedTickets = Ticket::where(['match_id'=>$match_id,'status'=>'Activated','type'=>'bus','bus_id'=>$bus->id])->count();
                        $capacity =  $bus->seats;
                        $availableTickets = $capacity - $bookedTickets;

                        if($availableTickets == 1){

                           $full_capacity =  in_array($bus->bus_number,$bookedBus);
                           if($full_capacity){

                                return redirect()->route('displayBookMatch',$match_id)->with('Error','one of choosen buses cannot contain this number of tickets so all tickets not boooked');

                           }else{

                                array_push($bookedBus,$bus->bus_number);
                                $ParentBusTicket++;
                                continue;
                           }


                        }elseif($availableTickets > 1 ){
                               $ParentBusTicket++;
                            if(array_key_exists($bus->bus_number,$unbookedBus)){

                                $unbookedBus[$bus->bus_number]--;

                            }else{

                                $unbookedBus[$bus->bus_number]=$availableTickets-1;

                            }
                            if($unbookedBus[$bus->bus_number] < 0){

                                return redirect()->route('displayBookMatch',$match_id)->with('Error','one of choosen buses cannot contain this number of tickets so all tickets not boooked');

                            }else{
                                continue;
                            }

                       }else{

                        return redirect()->route('displayBookMatch',$match_id)->with('Error','one of choosen buses cannot contain this number of tickets so all tickets not boooked');

                       }


                    }


                }else{
                    //Check if select two tickets for same dependent
                    if(in_array($ticket['owner_id'],$depsBusTickets)){

                        return redirect()->route('displayBookMatch',$match_id)->with('Error','Error in booking you want to book two match tickets for same dependent');

                    }else{

                        array_push($depsBusTickets,$ticket['owner_id']);
                    }

                    $ticket_exists = Ticket::where(['match_id'=>$match_id,'type'=>'bus','status'=>'Activated',
                    'user_id'=>Auth::id(),'dependent_id'=>$ticket['owner_id']])->exists();

                    $parent_ticket_exists = Ticket::where(['match_id'=>$match_id,'type'=>'bus','status'=>'Activated',
                    'user_id'=>Auth::id(),'dependent_id'=>null])->exists();

                    if($ticket_exists){

                        return redirect()->route('displayBookMatch',$match_id)->with('Error','One of dependents ticket already exists sorry all tickets not booked');

                    }else{

                        if($ParentBusTicket==1 || $parent_ticket_exists){

                            $bus = Bus::find($ticket['bus_id']);
                            $bookedTickets = Ticket::where(['match_id'=>$match_id,'status'=>'Activated','type'=>'bus','bus_id'=>$bus->id])->count();
                            $capacity =  $bus->seats;
                            $availableTickets = $capacity - $bookedTickets;


                            if($availableTickets == 1){

                               $full_capacity =  in_array($bus->bus_number,$bookedBus);
                               if($full_capacity){

                                    return redirect()->route('displayBookMatch',$match_id)->with('Error','one of choosen buses cannot contain this number of tickets so all tickets not boooked');

                               }else{
                                    array_push($bookedBus,$bus->bus_number);
                                    continue;
                               }


                            }elseif($availableTickets > 1 ){
                                if(array_key_exists($bus->bus_number,$unbookedBus)){

                                    $unbookedBus[$bus->bus_number]--;
                                }else{
                                    $unbookedBus[$bus->bus_number]=$availableTickets-1;
                                }
                                if($unbookedBus[$bus->bus_number] < 0){
                                    return redirect()->route('displayBookMatch',$match_id)->with('Error','one of choosen buses cannot contain this number of tickets so all tickets not boooked');

                                }else{

                                    continue;
                                }


                           }else{

                            return redirect()->route('displayBookMatch',$match_id)->with('Error','one of choosen buses cannot contain this number of tickets so all tickets not boooked');

                           }

                        }else{

                            return redirect()->route('displayBookMatch',$match_id)->with('Error','Parent not have bus ticket');

                        }


                    }

                }
            }else{

                //if can try to book both tickets at one step

                return redirect()->route('displayBookMatch',$match_id)->with('Error','Cannot book both tickets at one step');

            }

        }



        $this->response=true;
        $this->match_id=$match_id;
        $this->tickets=$tickets;
        $this->total_price=$request->totalPrice;



        $request->session()->put('match_id',$this->match_id);
        $request->session()->put('tickets',$this->tickets);

        $token = $this->getToken();
        $order =$this->createOrder($token);
        $payment_token = $this->getPaymentToken($order,$token);

        return view('paymob',compact('payment_token','match_id','tickets'));


    }





    public function getToken(){

        $response = Http::post('https://accept.paymob.com/api/auth/tokens',['username'=>env('PAYMOB_USERNAME'),'password'=>env('PAYMOB_PASSWORD')]);
        return $response->object()->token;
    }

    public function createOrder($token) {
        $items = [
            [ "name"=> "ASC1515",
                "amount_cents"=> "500000",
                "description"=> "Smart Watch",
                "quantity"=> "1"
            ],
            [
                "name"=> "ERT6565",
                "amount_cents"=> "200000",
                "description"=> "Power Bank",
                "quantity"=> "1"
            ]
        ];

        $data = [
            "auth_token" =>   $token,
            "delivery_needed" =>"false",
            "amount_cents"=> $this->total_price*100,
            "currency"=> "EGP",
            "items"=> $items,

        ];
        $response = Http::post('https://accept.paymob.com/api/ecommerce/orders', $data);
        return $response->object();
    }

    public function getPaymentToken($order, $token)
    {
        $billingData = [
            "apartment" => "803",
            "email" => "claudette09@exa.com",
            "floor" => "42",
            "first_name" => "Clifford",
            "street" => "Ethan Land",
            "building" => "8028",
            "phone_number" => "+86(8)9135210487",
            "shipping_method" => "PKG",
            "postal_code" => "01898",
            "city" => "Jaskolskiburgh",
            "country" => "CR",
            "last_name" => "Nicolas",
            "state" => "Utah"
        ];
        $data = [
            "auth_token" => $token,
            "amount_cents" => $this->total_price*100,
            "expiration" => 3600,
            "order_id" => $order->id, // this order id created by paymob
            "billing_data" => $billingData,
            "currency" => "EGP",
            "integration_id" => env('PAYMOB_INTEGRATION_ID')
        ];
        $response = Http::post('https://accept.paymob.com/api/acceptance/payment_keys', $data);
        return $response->object()->token;
    }


    public function callback(Request $request)
    {

        //this call back function its return the data from paymob and we show the full response and we checked if hmac is correct means successfull payment



        $data = $request->all();
        ksort($data);
        $hmac = $data['hmac'];
        $array = [
            'amount_cents',
            'created_at',
            'currency',
            'error_occured',
            'has_parent_transaction',
            'id',
            'integration_id',
            'is_3d_secure',
            'is_auth',
            'is_capture',
            'is_refunded',
            'is_standalone_payment',
            'is_voided',
            'order',
            'owner',
            'pending',
            'source_data_pan',
            'source_data_sub_type',
            'source_data_type',
            'success',
        ];
        $connectedString = '';
        foreach ($data as $key => $element) {
            if(in_array($key, $array)) {
                $connectedString .= $element;
            }
        }
        $secret = env('PAYMOB_HMAC');
        $hased = hash_hmac('sha512', $connectedString, $secret);
        if ( $hased == $hmac) {

            $status = $data['success'];

            if ( $status == "true" ) {

                $this->CreateTickets($request->session()->get('match_id'),$request->session()->get('tickets'));
                return redirect()->route('user.profile',Auth::id())->with('success','Payment process is done check your tickets');
            }
            else {
                return redirect()->route('displayBookMatch',$request->session()->get('match_id'))->with('paymentError','Error in payment process');
            }

        }else {
            return redirect()->route('displayBookMatch',$request->session()->get('match_id'))->with('paymentError','Error in payment process');

        }
    }







    public function CreateTickets($match_id,$tickets){
        //Add the Qrcode in local file
        $qrcode = QrCode::format('png')->size(300)->margin(1)->generate(auth()->id());
        $qrcodeName =time().'.png';
        $qrcodePath=public_path('imgs\qrCodes/'.$qrcodeName);
        file_put_contents($qrcodePath, $qrcode);




        //Get match information to firestore
        $match = AllMatches::find($match_id);

        foreach($tickets as $ticket){

            if($ticket['owner_id']!=null && $ticket['department_id']!=null && $ticket['bus_id']==null){
                //Match
                if($ticket['owner_id'] == Auth::id()){
                    Ticket::create([
                        'match_id'=>$match_id,
                        'user_id'=>Auth::id(),
                        'buy_date'=>now(),
                        'department_id'=>$ticket['department_id'],
                        'qrcode'=>$qrcodeName,
                    ]);


                }else{
                    Ticket::create([
                        'match_id'=>$match_id,
                        'user_id'=>Auth::id(),
                        'dependent_id'=>$ticket['owner_id'] ,
                        'buy_date'=>now(),
                        'department_id'=>$ticket['department_id'],
                        // 'qrcode'=>$qrcodeName,
                    ]);
                }

            }elseif($ticket['owner_id']!=null && $ticket['department_id']==null && $ticket['bus_id']!=null){
                //Bus
                if($ticket['owner_id'] == Auth::id()){
                    Ticket::create([
                        'match_id'=>$match_id,
                        'type'=>'bus',
                        'user_id'=>Auth::id(),
                        'buy_date'=>now(),
                        'dependent_id'=>null,
                        'bus_id'=>$ticket['bus_id'],

                    ]);



                }else{

                    Ticket::create([
                        'match_id'=>$match_id,
                        'type'=>'bus',
                        'user_id'=>Auth::id(),
                        'buy_date'=>now(),
                        'dependent_id'=>$ticket['owner_id'],
                        'bus_id'=>$ticket['bus_id']

                    ]);

                }

            }

        }
    }





}
