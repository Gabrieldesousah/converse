<?php

namespace App\Http\Controllers;

use App\Action;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ActionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = DB::select("
        SELECT user_id, Count(user_id) AS ContUser_id
        FROM actions
        GROUP BY user_id
        ORDER BY ContUser_id DESC
        LIMIT 150
        ");

        $user_id = Action::select('user_id', DB::raw('COUNT(user_id) AS count'))
            ->groupBy('user_id')
            ->orderBy('count', 'desc')
            ->paginate(30);

        $i = 0;
        foreach($user_id as $u)
        {
            if($u->user_id != ""){
                $user = DB::select("SELECT * FROM users WHERE id = {$u->user_id}");
                if(isset($user[0])){
                    //echo $user[0]->name . ": " . $u->ContUser_id . "<br>";
                    $userData[$i] = $user[0];
                    $userData[$i]->contActions = $u->ContUser_id;

                    $i++;
                }
            }
        }
        //dd($userData);
        return view('users.actions', ['userData' => $user_id]);
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
     * @param  \App\Action  $action
     * @return \Illuminate\Http\Response
     */
    public function show(Action $action)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Action  $action
     * @return \Illuminate\Http\Response
     */
    public function edit(Action $action)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Action  $action
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Action $action)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Action  $action
     * @return \Illuminate\Http\Response
     */
    public function destroy(Action $action)
    {
        //
    }
}
