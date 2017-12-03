<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Content;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
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
}
