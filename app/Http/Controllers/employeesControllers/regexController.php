<?php

namespace App\Http\Controllers\employeesControllers;

use App\Models\Regex;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\employeesRequests\addRegexRequest;

class regexController extends Controller
{
    public function displayRegex(){

        $regexes = Regex::get();
        return view('employees.admin.displayRegex',compact('regexes'));
    }
    public function addRegexForm(){

        return view('employees.admin.addRegex');
    }
    public function addRegex(addRegexRequest $request){

       Regex::create($request->all());
       return redirect()->route('admin.displayRegex');
    }
}
