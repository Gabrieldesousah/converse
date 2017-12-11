<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message2 extends Model
{
    protected $table = 'messages2';
    protected $fillable = ['error', 'user_id',	'chat_id',	'message',	'token',	'uid',
    'contact_uid',	'contact_name',	'contact_type',	'message_dtm',	'message_uid',	'message_cuid',	
    'message_body_url',	'message_body_size',	'message_body_thumb',	'message_body_caption',	'message_body_mimetype',	
    'message_dir',	'message_type',	'message_ack',	'event',	'status'];
}
