<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class UpdateController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Update Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the change of date for users as well as their
    | validation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    /**
     * Where to redirect users after update.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';


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
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */

    public function edit(User $user)
    {
    	$user_id = Auth::user()->id;

        $user = User::find($user->id);
        return view('users.edit')->with('user', $user);
    }

    protected function update(array $data)
    {
    	$user = User::find($request->id);
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        $user->save();
        return redirect('dashboard')->with('status_user', 'Comentário atualizado');
    }
}
