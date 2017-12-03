<?php

namespace App\Http\Controllers;

use App\Professor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfessorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    
/*******************************************************
    public function selectInMass()
    {
        $professors = DB::select('SELECT DISTINCT professor FROM materials ORDER BY professor');
        return view('professors.selectInMass', ["professors" => $professors]);
    }
    public function createInMass(Request $request)
    {

        $professors = $request->input("professors");
        var_dump($professors);

        for ($i=0;$i<count($professors);$i++)
        {
           //echo "<br> " . $i . ": " . $contents[$i];
           //DB::insert('INSERT INTO contents (name, area, area_id, created_at, updated_at) VALUES (?, ?, ?)', [$contents[$i], $datetime, $datetime]);
           $professor = new Professor;
           $professor->name = $professors[$i];
           $professor->save();
        }
    }
/*******************************************************

    /**
     * Display the specified resource.
     *
     * @param  \App\Professor  $professor
     * @return \Illuminate\Http\Response
     */
    public function show(Professor $professor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Professor  $professor
     * @return \Illuminate\Http\Response
     */
    public function edit(Professor $professor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Professor  $professor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Professor $professor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Professor  $professor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Professor $professor)
    {
        //
    }
}
