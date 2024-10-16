<?php

namespace App\Http\Controllers\employeesControllers;

use GuzzleHttp\Client;
use App\Models\Employee;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Http\Requests\employeesRequests\registerRequest;

class AdminRegisterController extends Controller
{

    public function store(registerRequest $request)
    {

        $employee_image=request()->file('profile_picture');
        $client = new Client();

        $response = $client->post('http://127.0.0.1:5000/detect_humans', [
        'multipart' => [
            [
                'name'     => 'file',
                'contents' => fopen($employee_image->getPathname(), 'r'),
                'filename' => $employee_image->getClientOriginalName()
            ]
        ]
       ]);
       $responseBody = json_decode($response->getBody(), true);

       if($responseBody['human_detected']==false){
        return redirect()->back()->with('registerError','This not human image or image with low quality');
       };

        $admin_key="admins1212";
        $driver_key="drivers1212";

        if($request->secret_key==$admin_key)
        {

            $manager = new ImageManager(new Driver());
            $image = $manager->read($employee_image)->scale(256,256);
            $profile_extension=$employee_image->getClientOriginalExtension();
            $profile_name =time().'.'.$profile_extension;
            $image->save('C:\xampp\htdocs\Fanzone_project\public\imgs\employees_pictures/'.$profile_name);

           $admin = Employee::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
                'ssn'=>$request->ssn,
                'gender'=>$request->gender,
                'personal_image'=>$profile_name
            ]);
            Auth::guard('employee')->login($admin);
            return redirect()->route('admin.index');
        }else if($request->secret_key==$driver_key){



            $manager = new ImageManager(new Driver());
            $image = $manager->read($employee_image)->scale(256,256);
            $profile_extension=$employee_image->getClientOriginalExtension();
            $profile_name =time().'.'.$profile_extension;
            $image->save('C:\xampp\htdocs\Fanzone_project\public\imgs\employees_pictures/'.$profile_name);


            Employee::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
                'ssn'=>$request->ssn,
                'type'=>'driver',
                'gender'=>$request->gender,
                'personal_image'=>$profile_name
            ]);
            return redirect()->route('admin.login');

        }else{

            return redirect()->back()->with('registerError','Wrong secret key');
        }



    }

}
