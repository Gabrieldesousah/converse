<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    /**
     * Get the user that owns the action.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function material()
    {
    	return $this->belongsTo('App\Material');
    }
}
