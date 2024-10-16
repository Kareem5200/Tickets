<?php

namespace App\Http\Controllers\employeesControllers;

use App\Models\Stadium;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\employeesRequests\addDepartmentRequest;
use App\Http\Requests\employeesRequests\updateDepartmentRequest;

class departmentController extends Controller
{
    public function displayDeprtments(Stadium $stadium){

        $departments=$stadium->departments;
        return view('employees.admin.displayDepartment',compact('departments','stadium'));


    }

    public function updateDeprtmentsForm(Department $department){

        return view('employees.admin.updateDepartment',compact('department'));

    }


    public function editDeprtments(updateDepartmentRequest $request,Department $department){

        $depsCapacity = Department::select('capacity')->where(['stadium_id'=>$department->stadium->id])->get()->pluck('capacity')->sum();
        $depsCapacity = $depsCapacity - $department->capacity + $request->capacity ;




        if($request->capacity <=$department->stadium->capacity && $depsCapacity<=$department->stadium->capacity ){
            $originalData=$department->only('name','capacity','price');
            $validatedData = $request->validated();
            $changedValues = array_diff_assoc($validatedData, $originalData);
            // dd($changedValues);
            $department->update($changedValues);
            return redirect()->route('admin.displayDeprtments',$department->stadium);
        }else{

            return redirect()->back()->with('capacityError','The total capaity of departments more the stadium');
        }


    }

    public function addDeprtmentsForm(Stadium $stadium){


        return view('employees.admin.addDepartment',compact('stadium'));

    }

    public function addDeprtment(addDepartmentRequest $request, Stadium $stadium){
        $dep = Department::where(['name'=>$request->name,'stadium_id'=>$stadium->id])->exists();

        if($dep){
            return redirect()->back()->with('capacityError','This Department already exists');

        }else{

            $depsCapacity = Department::where(['stadium_id'=>$stadium->id])->get()->pluck('capacity')->sum();
            $depsCapacity =$depsCapacity +$request->capacity;


            if($depsCapacity<=$stadium->capacity ){

                $stadium->departments()->create($request->all());
                return redirect()->route('admin.displayDeprtments',$stadium);
            }else{

                return redirect()->back()->with('capacityError','The capaity of department more the stadium');
            }
        }




    }
}
