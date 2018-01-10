<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Auth;
use Session;


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
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
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
            'first_name' => 'required|string|max:50',
            'surname'    => 'required|string|max:50',
            'email'      => 'required|string|email|max:100|unique:users',
            'password'   => 'required|string|min:4|max:24|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return User
     */
    protected function create(array $data)
    {
        $newUser = new User;
        $newUser->first_name = $data['first_name'];
        $newUser->surname = $data['surname'];
        $newUser->status = 0;
        $newUser->email = $data['email'];
        $newUser->password = $data['password'];
        $newUser->de_password = $data['password'];
        $newUser->api_token = true;
        $newUser->save();

        return $newUser;
    }

    protected function registered(Request $request, User $user)
    {
        if($user->status === 0){
            Auth::logout();
            Session::put('auth.error', trans("auth.new"));
            Session::put('auth.class', "alert-success");
        }
    }
}
