<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
 
    public $fillable = ['user_id', 'type', 'professor', 
    'content', 'area', 'description', 'college', 'file'];

    public function actions()
    {
    	$this->hasMany('App\Action');
    }
   
}
