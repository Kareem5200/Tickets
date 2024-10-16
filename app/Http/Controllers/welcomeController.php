<?php

namespace App\Http\Controllers;

use App\Mail\TestEmail;
use App\Http\Requests\emailRequest;
use Illuminate\Support\Facades\Mail;


class welcomeController extends Controller
{


    public function index(){

        return view('welcome');
    }


    public function highlights(){
        return view('highlights');
    }
    public function news(){
        return view('news');

    }


    public function showContactUs(){

        return view('contactUs');
    }


    public function sendMail(emailRequest $request){
        $sender=$request->mail;
        $message=$request->message;
        $name=$request->name;

      Mail::to(['karim8862@gmail.com'])->send(new TestEmail($sender,$message,$name));
      return redirect()->back()->with('Done','The mail sent');



    }




}
