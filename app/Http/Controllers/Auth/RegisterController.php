<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
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
    protected $redirectTo = '/';

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
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'iran_mobile', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ],
            [
                'name.required' => 'نام خود را وارد کنید',
                'name.string' => 'نام باید به حروف باشد',
                'name.max' => 'نام حداکثر باید ۲۵۵ کاراکتر باشد',
                'last_name.required' => 'نام خانوادگی خود را وارد کنید',
                'last_name.string' => 'نام خانوادگی باید به حروف باشد',
                'last_name.max' => 'نام خانوادگی حداکثر باید ۲۵۵ کاراکتر باشد',
                'email.required' => 'ایمیل خود را وارد کنید',
                'email.string' => 'ایمیل باید به حروف باشد',
                'email.max' => 'ایمیل حداکثر باید ۲۵۵ کاراکتر باشد',
                'email.email' => 'ایمیل صحیح نیست',
                'email.unique' => 'این ایمیل قبلا در سیستم ثبت شده',
                'phone.required' => 'شماره تماس خود را وارد کنید',
                'phone.unique' => 'این شماره تماس قبلا در سیستم ثبت شده',
                'phone.iran_mobile' => 'شماره موبایل صحیح نیست',
                'password.unique' => 'کلمه عبور خود را وارد کنید',
                'password.min' => 'کلمه عبور باید حداقل ۸ کاراکتر باشد',
                'password.confirmed' => 'کلمه عبور ها یکسان نیستند',
            ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        return User::create([
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
