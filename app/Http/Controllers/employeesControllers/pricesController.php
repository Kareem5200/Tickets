<?php

namespace App\Http\Controllers\employeesControllers;

use App\Models\Stadium;
use App\Models\Station;
use App\Models\tripPrice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\employeesRequests\addPriceRequest;
use App\Http\Requests\employeesRequests\updatePriceRequest;

class pricesController extends Controller
{
    public function displayprices(){


            $prices=tripPrice::get();
            return view('employees.admin.displayPrices',compact('prices'));

    }

    public function addPricesForm(){

            $stations=Station::where('status','=','active')->get();
            $stadiums=Stadium::get();
            return view('employees.admin.addPrice',compact('stations','stadiums'));


    }



    public function addPrices(addPriceRequest $request){
        // dd($request->all());


            $prices=tripPrice::where(['stadium_id'=> $request->stadium_id,'station_id'=> $request->station_id])->exists();
            if($prices){

                return redirect()->back()->with('duplicated_key','This key already exists');

            }else{

            tripPrice::create([
                // $request->all()
                'stadium_id'=> $request->stadium_id,
                'station_id'=> $request->station_id,
                'trip_price'=> $request->trip_price,
                'seat_price'=> $request->seat_price,
            ]);
            return redirect()->route('admin.displayprices');

            }


       }

    public function updatePricesForm(Stadium $stadium,Station $station){

            $prices = tripPrice::where(['stadium_id'=>$stadium->id,'station_id'=>$station->id])->first();
            return view('employees.admin.updatePrices',compact('prices'));

    }

    public function editPrices(updatePriceRequest $request,$stadium_id,$station_id){

            tripPrice::where(['stadium_id'=>$stadium_id,'station_id'=>$station_id])->update([
            'stadium_id'=>$stadium_id,
            'station_id'=>$station_id,
            'trip_price'=>$request->trip_price,
            'seat_price'=>$request->seat_price,
        ]

        );
            return redirect()->route('admin.displayprices');


    }

}
