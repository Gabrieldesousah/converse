<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Content;
use App\Material;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::guest()){
            $contents = Content::where('area_id', Auth::user()->area)->orderby('name')->paginate(21);
            //$contents = Content::where("area = ".$area)->orderby('name')->get();
            return view('contents.index', ['contents' => $contents]);
        }
        $contents = Content::orderby('name')->get();
        return view('welcome', ['contents' => $contents]);
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
    
    /*****************************************************
    public function selectInMass()
    {
        $materials = DB::select('SELECT DISTINCT content FROM materials');
        return view('materials.index', ["materials" => $materials]);
    }
    public function createInMass(Request $request)
    {

        $contents = $request->input("content");
        date_default_timezone_set('America/Sao_Paulo');
   		$datetime = date('Y-m-d H:i:s', time());
   		
        for ($i=0;$i<count($contents);$i++)
        {
           //echo "<br> " . $i . ": " . $contents[$i];
           DB::insert('INSERT INTO contents (name, created_at, updated_at) VALUES (?, ?, ?)', [$contents[$i], $datetime, $datetime]);
        }
    }
    *****************************************************/

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
        //App\Flight::where('active', 1)
        $materials = DB::select('SELECT * FROM materials WHERE content = ?', [$name]);

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
