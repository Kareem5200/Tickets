<?php

namespace App\Http\Controllers\employeesControllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests\employeesRequests\loginRequest;
use App\Models\Employee;

class AdminloginController extends Controller
{
    public function showLogin(){
    return view('employees.admin.login');
    }


    public function checkLogin(loginRequest $request){

        $employee = Employee::where('email','=',$request->email)->first();

        if($employee==null || $employee->type !="admin" || $employee->status !="active" ){

            return redirect()->back()->with('loginError','You are not admin to login or banned');

        }else{
            if(Auth::guard('employee')->attempt(['email'=>$request->email,'password'=>$request->password]))
            {


                   return redirect()->route('admin.index');

            }else
            {

            //    session()->flash('loginError','The credentials not match the records');
               // dd(session('loginError'));
               return redirect()->back()->with('loginError','The credentials not match the records')->withInput(['email'=>$request->email]);
            //    return redirect()->back()->withInput(['email'=>$request->email]);
            }

        }


        }
}

