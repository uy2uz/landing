<?php

namespace App\Http\Controllers\Auth;

use App\Entities\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;


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
    protected $redirectTo = '/my/account';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    
    public function register(Request $request)
    {
        try{
            $this->validator($request->all())->validate();
        }catch(\Exception $e){
            return back()->with('error', $e->getMessage());
        }
        $email = $request->input('email');
        $password = $request->input('password');
        $isAuth = $request->has('auth') ? TRUE : FALSE;
        
        $objUser = $this->create(['email' => $email, 'password' => $password]);
        
        if(!($objUser instanceof User)){
            return back()->with('error', "Попробуйте зарегистрироваться еще раз.");
        }
        if($isAuth){
            $this->guard()->login($objUser);
            return redirect(route('account'))->with('succes', 'Вы успешно зарегистрированы!');
        } else {
            echo 'Вы успешно прошли регистрацию!';
        }
        
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
            
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
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
        return User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
