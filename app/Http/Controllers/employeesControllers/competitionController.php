<?php

namespace App\Http\Controllers\employeesControllers;

use App\Models\Competition;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\employeesRequests\competitionRequest;

class competitionController extends Controller
{
    public function displayComptition(){

        $comps=Competition::get();
        return view('employees.admin.displayCompetition',compact('comps'));

    }

    public function addComptitionForm(){

        return view('employees.admin.addCompetition');

    }
    public function addComptition(competitionRequest $request){
        $comp = Competition::where(['name'=>$request->comp_name,'country'=>$request->comp_country,'session'=>$request->comp_session])->exists();
       if($comp){

        return redirect()->back()->with('Error','This competition already exists');
       }else{

           Competition::create([
               'name'=>$request->comp_name,
               'country'=>$request->comp_country,
            //    'price'=>$request->comp_price,
               'session'=>$request->comp_session,
           ]);
           return redirect()->route('admin.displayComptition');
       }
    }


}
