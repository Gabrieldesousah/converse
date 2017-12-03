<?php

namespace App\Http\Controllers;

use App\Record;
use App\Action;
use App\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::user()->id);
        $datetime = date("y-m-d H:i:s");
        $user->active = true;
        $user->last_login = $datetime;
        $user->save();

        //$actions = Action::orderby('id')->get();

        $user_id = Auth::user()->id;

        $actions = Action::where('user_id', $user_id)->orderBy("updated_at", "DESC")->limit(20)->get();

        //$historic = DB::select("SELECT * FROM actions where user_id = {$user_id} ORDER BY created_at DESC");

        $shared = DB::select("SELECT * FROM materials where user_id = {$user_id} ORDER BY id DESC LIMIT 20");

        $commented = DB::select("SELECT * FROM comments where user_id = {$user_id} ORDER BY updated_at, created_at ASC LIMIT 20");

        return view('dashboard', [
            'actions' => $actions,
            'shared' => $shared,
            'commented' => $commented
            ]);
    }
}
