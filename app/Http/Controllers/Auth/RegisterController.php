<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
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
    protected $redirectTo = RouteServiceProvider::HOME;

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
            'res_name' => ['required', 'string', 'max:255'],
            'res_contact' => ['required', 'numeric', 'max:9999999999'],
            'res_address' => ['required', 'string', 'max:255'],
            'res_email' => ['required', 'string', 'email', 'max:255','unique:restaurant'],
            'admin_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string','email', 'max:255','unique:admin'],
            'admin_contact' => ['required', 'numeric', 'max:9999999999','unique:admin'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }


    protected function create(array $data)
    {
        info('stored data');

        DB::table('restaurant')
            ->insert([
                'res_id' =>  $data['res_name']. date("YmdHis"),
                'res_name' => $data['res_name'],
                'res_contact' => $data['res_contact'],
                'res_address' =>$data['res_address'],
                'res_email' => $data['res_email'],
                'res_active' => 'yes',
            ]);
        return User::create([
            'admin_name' => $data['admin_name'],
            'email' => $data['email'],
            'admin_contact' => $data['admin_contact'],
            'admin_restaurant' => $data['res_name'].date("YmdHis"),
            'password' => Hash::make($data['password']),
            'admin_active' => 'yes',
        ]);
    }
}
