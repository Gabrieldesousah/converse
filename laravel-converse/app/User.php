<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    /**
     * Get the Actions for the User
     */
    public function actions()
    {
        return $this->hasMany('App\Action');
    }

    //tem q terminar de preencher aqui
    protected $fillable = [
        'name', 'email', 'password', 'area', 'course', 'college', 'state', 'city'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
