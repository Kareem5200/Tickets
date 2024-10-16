<?php

namespace App\Http\Controllers\employeesControllers;

use App\Models\Stadium;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\employeesRequests\stadiumRequest;
use App\Http\Requests\employeesRequests\updateStadiumRequest;

class stadiumController extends Controller
{
    public function displayStadium(){


                $stadiums=Stadium::get();
                return view('employees.admin.displayStadiums',compact('stadiums'));

    }


    public function addStadiumForm(){

        return view('employees.admin.addStadium');

    }


    public function addStadium(stadiumRequest $request){
        // dd($request->all());
        $stadium = Stadium::where('name','=',$request->name)->exists();

        // if($stadium){

        //     return redirect()->back()->with('Error','This Stadium already exists');

        //    }else{

            Stadium::create($request->all());
            return redirect()->route('admin.displayStadium');

        //    }



    }

    public function updateStadium(Stadium $stadium){


                   return view('employees.admin.updateStadium',compact('stadium'));

    }

    public function editStadium(updateStadiumRequest $request,Stadium $stadium){


            // $originalData=$stadium->only('name','capacity');
            // $validatedData = $request->validated();
            // $changedValues = array_diff_assoc($validatedData, $originalData);
            $stadium->update([
                'name'=>$request->name
            ]);
            return redirect()->route('admin.displayStadium');


    }



}
