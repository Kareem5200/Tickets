<?php

namespace App\Http\Controllers\Auth;

use App\Models\Team;
use App\Models\User;
use GuzzleHttp\Client;
use Kreait\Firebase\Factory;
use App\Http\Controllers\Controller;
use App\Rules\DateValidator;
use App\Rules\ProfileImageValidator;
use App\Rules\regexValidator;
use App\Rules\SSNImageValidator;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Validator;

use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    protected $firestore;
    protected $storage;
    protected $auth;
    protected $factory;

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');

        // $this->firestore =new FirestoreClient([
        // 'keyFilePath' => 'C:\xampp\htdocs\Fanzone_project\storage\fanzone2.json'
        //  ]);



         $this->factory = (new Factory)
        ->withServiceAccount('C:\xampp\htdocs\Fanzone_project\storage\fanzone2.json')
        ->withDatabaseUri('https://console.firebase.google.com/project/fanzone-5210f/firestore/databases/-default-/data/~2F')
        ->withProjectId('fanzone-5210f');

         $this->firestore = $this->factory->createFirestore();
        $this->auth = $this->factory->createAuth();





    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

     public function showRegistrationForm()
     {
        $teams=Team::where('division','=','first')->get();
         return view('auth.register',compact('teams'));
     }
    protected function validator(array $data)
    {

        return Validator::make($data, [

            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required','confirmed',Password::min(8)->mixedCase()->numbers()->symbols()],
            'phone1' => ['required', 'numeric','digits:11','unique:users,phone_1','regex:/^01[0125][0-9]{8}$/'],
            'gender'=>['required'],
            'country'=>['required'],
            'birth_date'=>['required','date',new DateValidator],
            'passport_id'=>['nullable',new regexValidator],
            'team'=>['required'],
            'profile_picture' => ['required','image','mimes:jpeg,png,jpg,gif','max:2048',new ProfileImageValidator],
            'ssn_image' =>['image','mimes:jpeg,png,jpg,gif','max:2048','nullable',new SSNImageValidator],
        ]);


    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $team = Team::find($data['team']);

        //Handle Profile picture


        $profile=request()->file('profile_picture');
        $ssn=request()->file('ssn_image');

        $client = new Client();

        if($ssn !=null){
            $response2 = $client->post('http://127.0.0.1:6000/ocr', [
                'multipart' => [
                    [
                        'name'     => 'file',
                        'contents' => fopen($ssn->getPathname(), 'r'),
                        'filename' => $ssn->getClientOriginalName()
                        ]
                        ]
                    ]);

            $responseBody2 = json_decode($response2->getBody(), true);
        }

        $manager = new ImageManager(new Driver());
        $image = $manager->read($profile)->scale(256,256);
        $personalImage_extension=$profile->getClientOriginalExtension();
        $personalImage_name =time().'.'.$personalImage_extension;
        $image->save('C:\xampp\htdocs\Fanzone_project\public\imgs\profile_pictures/'.$personalImage_name);


        $user = $this->auth->createUserWithEmailAndPassword($data['email'],$data['password']);
        $profileImageContents = file_get_contents($profile);
        $imagesFile = 'images/'. $personalImage_name;


        $storage = $this->factory->createStorage();
        $storageClient = $storage->getStorageClient();
        $defaultBucket = $storage->getBucket();

        $defaultBucket->upload($profileImageContents, [
            'name' => $imagesFile
        ]);
        $object = $defaultBucket->object($imagesFile);
        $profileImageUrl = $object->signedUrl(new \DateTime('9999-12-31T23:59:59Z'));


        if($data['passport_id']==null)
        {

            //Handle SSN image
            $image2 = $manager->read(request()->file('ssn_image'))->scale(256,256);
            $photo=request()->file('ssn_image');
            $ssnImage_extension=request()->file('ssn_image')->getClientOriginalExtension();
            $ssnImage_name=time().'.'.$ssnImage_extension;
            $image2->save('C:\xampp\htdocs\Fanzone_project\public\imgs\ssn_images/'.$ssnImage_name);


            $ssnImageContents = file_get_contents(request()->file('ssn_image'));
            $ssnFile='ssnImages/'.$ssnImage_name;
            $defaultBucket->upload($ssnImageContents, [
                'name' => $ssnFile
            ]);
            $object2 = $defaultBucket->object($ssnFile);
            $ssnImageUrl = $object2->signedUrl(new \DateTime('9999-12-31T23:59:59Z'));




             $this->firestore->database()->collection('Fan')->document($user->uid)->set([
                'fullname'=>$data['name'],
                'gender'=>$data['gender'],
                'phoneNumber'=>$data['phone1'],
                'SSNimage'=>$ssnImageUrl,
                'ssn'=>$responseBody2['national_id'],
                'fanImageURL'=>$profileImageUrl,
                'passportID'=>null,
                'supportedTeam'=>$team->name,
                'address'=>$data['country'],
                'status'=>'allowed',
                'panned_date'=>null,
                'panned_until'=>null,
            ]);


            //Create user in firestore
            return User::create([

                'name' =>$data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'phone_1'=>$data['phone1'],
                'gender'=>$data['gender'],
                'address'=>$data['country'],
                'birth_date'=>$data['birth_date'],
                'ssn'=>$responseBody2['national_id'],
                'team_id'=>$data['team'],
                'personal_image'=>$personalImage_name,
                'ssn_image'=>$ssnImage_name,

            ]);



        }else{


             $this->firestore->database()->collection('Fan')->document($user->uid)->set([
                'fullname'=>$data['name'],
                'gender'=>$data['gender'],
                'phoneNumber'=>$data['phone1'],
                'SSNimage'=>null,
                'fanImageURL'=>$profileImageUrl,
                'passportID'=>$data['passport_id'],
                'supportedTeam'=>$team->name,
                'address'=>$data['country'],
                'status'=>'allowed',
                'panned_date'=>null,
                'panned_until'=>null,
            ]);



            //Create user in firestore
            return User::create([

                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'phone_1'=>$data['phone1'],
                'gender'=>$data['gender'],
                'address'=>$data['country'],
                'birth_date'=>$data['birth_date'],
                'passport_id'=>$data['passport_id'],
                'team_id'=>$data['team'],
                'personal_image'=>$personalImage_name,
                //'ssn_image'=>$ssnImage_name,

            ]);
        }




    }
}
