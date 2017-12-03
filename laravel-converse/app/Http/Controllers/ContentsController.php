<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Content;
use App\Material;
use App\Search;

class ContentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contents = Content::where('area_id', Auth::user()->area)->orderby('name')->paginate(48);
        return view('contents.index', ['contents' => $contents]);
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

/***********************************************************
    public function selectInMass()
    {
        $materials = DB::select('SELECT DISTINCT content FROM materials ORDER BY `content` ASC');
        return view('contents.selectInMass', ["materials" => $materials]);
    }
    public function createInMass(Request $request)
    {

        $contents = $request->input("content");
        date_default_timezone_set('America/Sao_Paulo');
   		$datetime = date('Y-m-d H:i:s', time());
   		
        for ($i=0;$i<count($contents);$i++)
        {

        $var = $contents[$i];
        $var = str_replace(" VII" , " 7", $var);
        $var = str_replace(" VI"  , " 6", $var);
        $var = str_replace(" V"   , " 5", $var);
        $var = str_replace(" IV"  , " 4", $var);
        $var = str_replace(" III" , " 3", $var);
        $var = str_replace(" II"  , " 2", $var);
        $var = str_replace(" I"   , " 1", $var);


           //echo "<br> " . $i . ": " . $contents[$i];
           DB::insert('INSERT INTO contents (name, created_at, updated_at) VALUES (?, ?, ?)', [$var, $datetime, $datetime]);
        }
    }
**********************************************************

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
    public function show($name)
    {
        $var[1] = $name;
        $var[2] = str_replace(" 7" , " VII", $name);
        $var[3] = str_replace(" 6" , " VI", $name);
        $var[4] = str_replace(" 5" , " V", $name);
        $var[5] = str_replace(" 4" , " IV", $name);
        $var[6] = str_replace(" 3" , " III", $name);
        $var[7] = str_replace(" 2" , " II", $name);
        $var[8] = str_replace(" 1" , " I", $name);

        //App\Flight::where('active', 1)
        $materials = DB::select('SELECT * FROM materials WHERE 
            content = ? OR
            content = ? OR
            content = ? OR
            content = ? OR
            content = ? OR
            content = ? OR
            content = ? OR
            content = ?
            ', 
            [
            $var[1],
            $var[2],
            $var[3],
            $var[4],
            $var[5],
            $var[6],
            $var[7],
            $var[8],
            ]);
        
        if($name != "<--" and $name != "")
        {
            $user_id = Auth::user() ? Auth::user()->id : null;

            $search = new Search();
            $search->keywords = $name;
            $search->user_id = $user_id;
            $search->save();
        }
        return view('contents.show', ['materials' => $materials]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
