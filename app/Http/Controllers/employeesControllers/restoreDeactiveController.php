<?php

namespace App\Http\Controllers\employeesControllers;

use App\Models\Bus;
use App\Models\Station;
use App\Models\Employee;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class restoreDeactiveController extends Controller
{
    public function displayDeactiveEmployee(){


            $deactiveEmployees =Employee::where('status','=','deactive')->get();
            return view('employees.admin.deactiveEmployees',compact('deactiveEmployees'));

    }

    public function returnDeactiveEmployee(Employee $employee){


            $employee->update([
                'status'=>'active'
            ]);

       
            return redirect()->route('admin.displayDeactiveEmployee');

    }
    public function displayDeactiveBuses(){


            $deactiveBuses =Bus::where('status','=','deactive')->get();
            return view('employees.admin.deactiveBuses',compact('deactiveBuses'));

    }
    public function returnDeactiveBus(Bus $bus){

            $bus->update([
                'status'=>'active'
            ]);
            return redirect()->route('admin.displayDeactiveBuses');

    }

    public function displayDeactiveStations(){

            $deactiveStations =Station::where('status','=','deactive')->get();
            return view('employees.admin.deactiveStations',compact('deactiveStations'));
        }

    public function returnDeactiveStation(Station $station){

            $station->update([
                'status'=>'active'
            ]);
            return redirect()->route('admin.displayDeactiveStations');

    }






}
