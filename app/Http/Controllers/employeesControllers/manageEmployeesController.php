<?php

namespace App\Http\Controllers\employeesControllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use App\Http\Controllers\Controller;
use App\Models\DriverTrip;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class manageEmployeesController extends Controller
{

    public function getEmployees(){

            $allEmployees=Employee::where('status','=','active')->where('id','!=',Auth::id())->get();

            return view('employees.admin.manageEmployees',compact('allEmployees'));



    }
    public function panEmployee(Employee $employee){

        if($employee->id !== Auth::id()){
            $driverTrips = DriverTrip::where('driver_id','=',$employee->id)->where('trip_date','>=',now())->exists();

            if($driverTrips){

                return redirect()->back()->with('error','This driver has trips must change the driver of this trips');
            }else{

                $employee->update([
                    'status'=>'deactive'
                ]);

                return redirect()->route('admin.getEmployees');
            }

        }else{
            abort(403);
        }


    }
}
