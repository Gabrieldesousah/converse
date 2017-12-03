<?php

namespace App\Http\Controllers;

use App\Material;
use App\Search;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
 
        $keywords = Search::select('keywords', DB::raw('COUNT(keywords) AS count'))
            ->groupBy('keywords')
            ->orderBy('count', 'desc')
            ->paginate(30);

        return view('materials.searches')->with('keywords', $keywords);
    }

    public function key(Request $request)
    {

        $user_id = Auth::user() ? Auth::user()->id : null;

        $search = new Search();
        $search->keywords = $request->input("key");
        $search->user_id = $user_id;
        $search->save();

        $search = $_GET['key'];

        $var[1] = $search;
        $var[2] = str_replace(" 7" , " VII", $search);
        $var[3] = str_replace(" 6" , " VI", $search);
        $var[4] = str_replace(" 5" , " V", $search);
        $var[5] = str_replace(" 4" , " IV", $search);
        $var[6] = str_replace(" 3" , " III", $search);
        $var[7] = str_replace(" 2" , " II", $search);
        $var[8] = str_replace(" 1" , " I", $search);

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
        

        $materials = DB::table('materials')
            ->where("content", "like", "%$search%")
            ->orWhere("professor", "like", "%$search%")
            ->orWhere("description", "like", "%$search%")
            ->orWhere("college", "like", "%$search%")
            ->orWhere("id", "$search")
            ->get();

       /* $materials = DB::select("
        SELECT * FROM materials WHERE
            content LIKE '%$search%' OR
            professor LIKE '%$search%' OR
            description LIKE '%$search%' OR
            college LIKE '$search'    
        ");
        */

        return view('materials.search', ['search' => $search, 'materials' => $materials]);
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
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function show(Material $material)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function edit(Material $material)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Material $material)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function destroy(Material $material)
    {
        //
    }
}
