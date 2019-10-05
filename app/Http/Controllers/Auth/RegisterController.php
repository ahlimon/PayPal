<?php



namespace App\Http\Controllers\Auth;



use App\User;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;

use Illuminate\Foundation\Auth\RegistersUsers;



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
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'gender' => 'required|string|max:10',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'school' => 'required',
            'add1' => 'required',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:43',
            'zip' => 'required|digits:5',
            'phone' => 'required|digits:10',
            ]);

    }



    /**

     * Create a new user instance after a valid registration.

     *

     * @param  array  $data

     * @return \App\User

     */

    protected function create(array $data)

    {

        $user =  User::create([

            'fname' => $data['fname'],
            'mname' =>$data['mname'],
            'lname' => $data['lname'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'token' => str_random(25),
            'gender'=>$data['gender'],
            'school'=>$data['school'],
            'speciality'=>$data['speciality'],
            'add1'=>$data['add1'],
            'add2'=>$data['add2'],
            'city'=>$data['city'],
            'state'=>$data['state'],
            'zip'=>$data['zip'],
            'phone'=>$data['phone'],
            'membership'=>null,
        ]);

        if($user->sendVerificationEmail()){

            return $user;

        }    
    }






    

}

