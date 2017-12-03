<?php

namespace App\Http\Controllers;

use App\Material;
use App\Content;
use App\User;
use App\Professor;
use App\Comment;
use App\Action;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MaterialsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
    }

    public function index()
    {
        //index
        //teste
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Share
        $contents = Content::all();
        $professors = Professor::all();
        return view('materials.share', [
            'contents' => $contents,
            'professors' => $professors
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //if( $_FILES['file']['size'] >= 1028*10 )
        //{ die(); }
        
        $material = new Material($request->except(['file']));

        if( isset($_FILES['file']) and $_FILES['file'] != "" )
        {
            $file = $_FILES['file'];

            $file_explode = explode('.',$_FILES['file']['name']);
            $file_name = $file_explode[0];
            $extent = strtolower(end($file_explode));
            
            $material->file = $file_name
                .'-seumerito-'
                .md5(time())
                .'.'.$extent;

            if(move_uploaded_file(
                $file['tmp_name'], 
                $_SERVER['DOCUMENT_ROOT'] .
                "/public" .
                "/storage" .
                "/materials" .
                '/'.
                basename($material->file)
            ))
            {
                $c = Content::where('name', "{$request->content}")->get();

                if( count($c) === 0 ){
                    $content = new Content();                    

                    $var = $request->content;
                    $var = str_replace(" VII" , " 7", $var);
                    $var = str_replace(" VI"  , " 6", $var);
                    $var = str_replace(" V"   , " 5", $var);
                    $var = str_replace(" IV"  , " 4", $var);
                    $var = str_replace(" III" , " 3", $var);
                    $var = str_replace(" II"  , " 2", $var);
                    $var = str_replace(" I"   , " 1", $var);

                    $content->name = $var;

                    $content->area_id = $request->area;
                    $content->save();
                }


                $p = Professor::where('name', "{$request->professor}")->get();

                if( count($p) === 0 ){
                    $professor = new Professor();

                    $var = $request->professor;

                    $professor->name = $var;
                    $professor->area = $request->area;
                    $professor->save();
                }

                if( $material->save() ){
                    //echo "material salvo";
                    return redirect('/materials/share')->with('status_success', 'Arquivo enviado com sucesso!');
                }

            } else {
                //echo "N«ªo moveu o arquivo";
                return redirect('/materials/share')->with('status_danger', 'N«ªo moveu o arquivo');
            }
        } else {
            //echo "N«ªo recebeu o arquivo";
            return redirect('/materials/share')->with('status_danger', 'N«ªo recebeu o arquivo');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function show(Material $material)
    {        
        $user = Auth::user() ? Auth::user() : null;

        $material =  Material::find($material);

        $comments = DB::select('SELECT * FROM comments WHERE material_id = '.$material->id);

        return view('materials.show', [
            'material' => $material,
            'comments' => $comments,
            'user'     => $user
            ]);
    }

    public function show_file($material)
    {
        $this->middleware('auth');
        if(!Auth::user())
        {
            return redirect('/login');
        }

        $user_id = Auth::user() ? Auth::user()->id : null;

        $action = Action::find($material);
        $action->user_id = $user_id;
        $action->action = "view";
        $action->material_id = $material;
        $action->save();
        
        $material  =  Material::find($material);
        $file_path = 'storage' . '/' .
                     'materials' . '/' .
                      $material->file;
        return view('materials.file', [
            'material' => $material, 
            'file_path' => $file_path
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function edit(Material $material)
    {
        $material = Material::find($material);
        $contents = Content::all();
        $professors = Professor::all();

        return view('materials.edit', [
            'material' => $material,
            'contents' => $contents,
            'professors' => $professors
        ]);
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
        $material = Material::find($request->id);
        $material->type        = $request->type;
        $material->content     = $request->content;
        $material->professor  = $request->professor;
        $material->area        = $request->area;
        $material->description = $request->description;
        $material->college     = $request->college;

        $c = Content::where('name', "{$request->content}")->get();

                if( count($c) === 0 ){
                    $content = new Content();                    

                    $var = $request->content;
                    $var = str_replace(" VII" , " 7", $var);
                    $var = str_replace(" VI"  , " 6", $var);
                    $var = str_replace(" V"   , " 5", $var);
                    $var = str_replace(" IV"  , " 4", $var);
                    $var = str_replace(" III" , " 3", $var);
                    $var = str_replace(" II"  , " 2", $var);
                    $var = str_replace(" I"   , " 1", $var);

                    $content->name = $var;

                    $content->area = $request->area;
                    $content->save();
                }


                $p = Professor::where('name', "{$request->professor}")->get();

                if( count($p) === 0 ){
                    $professor = new Professor();

                    $var = $request->professor;

                    $professor->name = $var;
                    $professor->area = $request->area;
                    $professor->save();
                }


        if($material->save())
        {
            return redirect('/material/'.$request->id)->with('status', 'Arquivo editado');
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function destroy(Material $material)
    {
        $material = Material::find($material);
        $material->delete();
        return redirect('/')->with('status_delete', 'Material apagado');;
    }
}
