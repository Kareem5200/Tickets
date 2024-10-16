<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\AllMatches;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth:web']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {



        $sample_of_matches = AllMatches::whereBetween('match_date',[now()->tomorrow(),now()->addDays(15)])->limit(4)->get();
        $sampleOfMatches=[];


        foreach($sample_of_matches as $match){
            $matchDate = Carbon::parse($match->match_date);
            $match->match_date=$matchDate->format('Y-M-d');
            array_push($sampleOfMatches,$match);

        }
         return view('home',compact('sampleOfMatches'));

    }
}
