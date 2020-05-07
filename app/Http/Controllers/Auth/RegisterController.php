<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\Location;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;

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


    protected $validColumns = [
        'firstName'    =>    'required|string|max:20',
        'lastName'     =>    'required|string|max:20',
        'email_phone'  =>    'required|string|max:200|unique:users',
        //'phone'      =>    'required|numeric|digits_between:10,13|unique:users',
        'birthday'     =>    'required|date|max:20',
        'gender'       =>    'required|string|max:10',
        'password'     =>    'required|string|min:6|confirmed',
        "location"     =>    "required|int",
    ];

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
        return Validator::make($data, $this->validColumns);
    }

    /**
     * Show Register form
     *
     * @return void
     */
    public function showRegistrationForm()
    {
        $locations = Location::all();
        return view('auth.register', ["locations" => $locations]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {


        $user = User::create([
            'firstName' => $data['firstName'],
            'lastName' => $data['lastName'],
            'email_phone' => $data['email_phone'],
            //'phone' => $data['phone'],
            'birthday' => $data['birthday'],
            'gender' => $data['gender'],
            'password' => bcrypt($data['password']),
        ]);
        $user
            ->roles()
            ->attach(Role::where('name', 'Administrator')->first());
        return $user;
    }
}
