<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->permissions != 1){
            return redirect('/');
        }
        
        $users = User::paginate(15);
        //$users = DB::table('users')->where("active","1")->orWhere("name", "Gabriel")->paginate(15);
        return view('users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view("users.show")->with("user", $user);
    }

    public function search(Request $request)
    {
        $search = $_GET['key'];

        $user = DB::table('users')
            ->where("name", "like", "%$search%")
            ->orWhere("email", "like", "%$search%")
            ->orWhere("course", "like", "%$search%")
            ->orWhere("college", "like", "%$search%")
            ->orWhere("id", "$search")
            ->get();

        return view('users.search', ['search' => $search, 'users' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if(isset($user) and $user->id != null){
            $user_id = $user->id;
        } else {
            $user_id = Auth::user()->id;
        }

        $user = User::find($user_id);

        if( Auth::user()->permissions == true or Auth::user()->id === $user_id) {
            return view('auth.edit')->with('user', $user);
        }else{
            return redirect('/');
        }
    }
    public function editpass(User $user)
    {
        //$user = Auth::user();
        //$user = User::find($user->id);

        if(isset($user) and $user->id != null){
            $user_id = $user->id;
        } else {
            $user_id = Auth::user()->id;
        }

        $user = User::find($user_id);

        return view('auth.passwords.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request, User $user)
    {

        if(isset($user) and $user->id != null){
            $user_id = $user->id;
        } else {
            $user_id = Auth::user()->id;
        }

        $user = User::find($user_id);
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->college  = $request->college;
        $user->area     = $request->area;
        $user->course   = $request->course;
        $user->state    = $request->state;
        $user->city     = $request->city;
        $user->country  = "Brazil";

        if( $user->save() ){
            return redirect('dashboard')->with('status_user', 'Dados atualizados'); 
        }
    }
    public function updatePass(Request $request, User $user)
    {
        $user = User::find(Auth::user()->id);
        
        $user->password = bcrypt($request->password);

        if( $user->save() ){
            return redirect('dashboard')->with('status_user', 'Senha atualizada');  
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
