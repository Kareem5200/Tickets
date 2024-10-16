<?php

namespace App\Http\Controllers\employeesControllers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\employeesRequests\teamRequest;
use App\Http\Requests\employeesRequests\updateTeamRequest;

class teamsController extends Controller
{
    public function displayTeams(){
            $teams=Team::get();
            return view('employees.admin.displayTeams',compact('teams'));
    }

    public function addTeamsForm(){

            return view('employees.admin.addTeams');
    }

    public function addTeam(teamRequest $request){

            $logoExtension = request()->file('logo')->getClientOriginalExtension();
            $logoName=time().".".$logoExtension;
            $logoPath='imgs/teams';
            request()->file('logo')->move($logoPath,$logoName);


                Team::create([
                    'name'=>$request->team_name,
                    'logo'=>$logoName,
                    'division'=>$request->division,
                ]);

            return redirect()->route('admin.displayTeams');
    }

    public function updateTeam(Team $team){

       return view('employees.admin.updateTeam',compact('team'));

    }

    public function editTeam(updateTeamRequest $request,Team $team){

        // if($request->name == null){

        //     return redirect()->back()->with('fillError','Please must fill the name of team');

        // }else{



          if($request->logo != null){

            $logoExtension = $request->logo->getClientOriginalExtension();
            $logoName = time().".".$logoExtension;
            $path = "imgs/teams";
            $request->logo->move($path,$logoName);

            if($request->division != null){

                $team->update([
                    'name'=>$request->name,
                    'division'=>$request->division,
                    'logo'=>$logoName,
                ]);

                return redirect()->route('admin.displayTeams');
            }else{

                $team->update([
                    'name'=>$request->name,
                    'logo'=>$logoName,
                ]);

                return redirect()->route('admin.displayTeams');
            }




          }else{

            if($request->division != null){
                // dd($request->division);
                $team->update([
                    'name'=>$request->name,
                    'division'=>$request->division,

                ]);

                return redirect()->route('admin.displayTeams');
            }else{

                $team->update([
                    'name'=>$request->name,
                ]);

                return redirect()->route('admin.displayTeams');
            }

          }
        // }




     }



}
