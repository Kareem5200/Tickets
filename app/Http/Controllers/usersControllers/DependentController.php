<?php

namespace App\Http\Controllers\usersControllers;

use Carbon\Carbon;
use App\Models\User;
use GuzzleHttp\Client;
use App\Models\Dependent;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Drivers\Gd\Driver;
use PHPUnit\Framework\Attributes\Depends;
use App\Http\Requests\usersRequests\addDependentRequest;

class DependentController extends Controller
{






    public function displayDependents(){

        $dependentsUnder16 = Dependent::where(['status'=>'allowed','user_id'=>Auth::id()])->get();
        return view('users.family',compact('dependentsUnder16'));
    }

    public function deleteDependent(Dependent $dependent){

        $dependent->update([
                'status'=>'panned'
             ]);
        return redirect()->route('user.displayDependents',$dependent->parent);

    }


    public function showAddDepForm(){

        return view('users.addDep');
    }


    public function store(addDependentRequest $request){


        $dependent_image=request()->file('personal_image');
        $client = new Client();

        $response = $client->post('http://127.0.0.1:5000/detect_humans', [
        'multipart' => [
            [
                'name'     => 'file',
                'contents' => fopen($dependent_image->getPathname(), 'r'),
                'filename' => $dependent_image->getClientOriginalName()
            ]
        ]
       ]);
       $responseBody = json_decode($response->getBody(), true);
       if($responseBody['human_detected']==false){
        return redirect()->back()->with('error','This not human image or image with low quality');
       };


        $century =substr($request->ssn, 0, 1);
        $year="20".substr($request->ssn, 1, 2);
        $month=substr($request->ssn, 3, 2);
        $day=substr($request->ssn, 5, 2);
        $birth_date=$year.'-'.$month.'-'.$day;

        $dateOf16Years = carbon::now()->subYears(16);

        // dd($birth_date >= $dateOf16Years);

        if($century=="3" && $birth_date >= $dateOf16Years){
            // dd('ok');
            $user = User::find(Auth::id());



            $manager = new ImageManager(new Driver());
            $image = $manager->read($dependent_image)->scale(256,256);
            $personalImage_extension=$dependent_image->getClientOriginalExtension();
            $personalImage_name =time().'.'.$personalImage_extension;
            $image->save('C:\xampp\htdocs\Fanzone_project\public\imgs\dependents_pictures/'.$personalImage_name);

            $image2 = $manager->read(request()->file('birth_certificate'))->scale(256,256);
            $birthcCertificate_extension=request()->file('birth_certificate')->getClientOriginalExtension();
            $birthcCertificate_name =time().'.'.$birthcCertificate_extension;
            $image2->save('C:\xampp\htdocs\Fanzone_project\public\imgs\birth_certificates/'.$birthcCertificate_name);


            // dd($request->birth_date);
                Dependent::create([
                'name'=>$request->name,
                'ssn'=>$request->ssn,
                'gender'=>$request->gender,
                'user_id'=>Auth::id(),
                'birth_date'=>$birth_date,
                'personal_image'=>$personalImage_name,
                'birth_certificate'=>$birthcCertificate_name,
             ]);

            // return Redirect::to(route('user.displayDependents',$user_id), 307);
             return redirect()->route('user.displayDependents');
        }else{

            return redirect()->back()->with('ageError', 'please the age of child must be less than 16');

        }

    }




}
