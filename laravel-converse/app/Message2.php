<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message2 extends Model
{
    protected $table = 'messages';
    protected $fillable = ['setor', 'canal', 'em_espera'];
}
