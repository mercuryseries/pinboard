<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers;

    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['getLogout', 'getEdit', 'patchEdit']]);
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function getEdit(){
        return view('auth.edit');
    }

    public function patchEdit(UpdateUserRequest $request){
        if(theCurrentPasswordProvidedIsValid($request)){

            updateUserInfos($request);
            flash('You account has been successfully updated.');
            return redirect()->back();

        } else {
            return redirect()->back()->withErrors(['current_password' => 'Your current password is incorrect.']);
        }
    }

    private function theCurrentPasswordProvidedIsValid($request){
        return Hash::check($request->current_password, $request->user()->password);
    }

    private function updateUserInfos($request){
        if(userWantsToUpdateTheirPassword($request->password)){
            $data = $request->all();
            $data['password'] = bcrypt($request->password);
            Auth::user()->update($data);
        } else {
            Auth::user()->update($request->except('password'));
        }
    }

    private function userWantsToUpdateTheirPassword($password){
        return $password != '';
    }
}
