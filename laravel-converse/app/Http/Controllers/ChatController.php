<?php

namespace App\Http\Controllers;

use App\Chat;
use App\Message;
use App\Message2;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;


class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $phones = DB::select('SELECT DISTINCT contact_uid FROM messages2 ORDER BY `created_at` DESC');
        //dd($phones);
        //$chat = new Chat;
        //$chats = $chat::all();

        return  view('chat.index', [
            'chats'    => $phones
        ]);
    }

    public function wpp_receive()
    {
        $event = $_POST["event"];
        $token = $_POST["token"];        
        $contact = $_POST["contact"];
        $message = $_POST["message"];

        $msg2 = new Message2();
        
        $msg2->message       = isset($message["body"]["text"]) ? $message["body"]["text"] : "";
        $msg2->event         = $event;            
        $msg2->token         = $token;            
        $msg2->contact_uid   = $contact["uid"];            
        $msg2->contact_name  = $contact["name"];            
        $msg2->contact_type  = $contact["type"];            
        $msg2->message_dtm   = $message["dtm"];            
        $msg2->message_uid   = $message["uid"];            
        $msg2->message_cuid  = $message["cuid"];            
        $msg2->message_dir   = $message["dir"];            
        $msg2->message_type  = $message["type"];            
        $msg2->message_ack   = $message["ack"];

        $msg2->message_body_url = isset($message["body"]["url"]) ? $message["body"]["url"] : "";
        $msg2->message_body_size = isset($message["body"]["size"]) ? $message["body"]["size"] : "";
        $msg2->message_body_thumb = isset($message["body"]["thumb"]) ? $message["body"]["thumb"] : "";
        $msg2->message_body_caption = isset($message["body"]["caption"]) ? $message["body"]["caption"] : "";
        $msg2->message_body_mimetype = isset($message["body"]["mimetype"]) ? $message["body"]["mimetype"] : "";

        $user = new User();
        $find_user = $user::where("phone", $msg2->contact_uid)->get();

        if(!isset($find_user[0])){
            $user->name = $msg2->contact_name;
            $user->phone = $msg2->contact_uid;
            $user->email = "";
            $user->type = $msg2->contact_type;

            if($user->save()){
                $msg2->user_id = $user->id;                
            }
        } else {
            $msg2->user_id = $find_user[0]->id;
        }

        $msg2->save();
        
        return "true";     
    }



    public function loginForm() {
        return view('chat.login');
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
    public function store_wpp(Request $request, $chat_id)
    {   
        //dd($request);            
        $text = $request->input('usermsg');

        //$data = array($id, $_SESSION['name'], stripslashes(htmlspecialchars($text)))

        $message = new Message2();
        $message->user_id = Auth::user()->id;
        $message->contact_uid = $chat_id;
        $message->status = 0;
        $message->message_dir = "s";//output of site
        $message->message = $text;
        
            
        $CURLOPT_URL = "https://www.waboxapp.com/api/send/chat";
        $CURLOPT_SSL_VERIFYPEER =  false;
        $CURLOPT_SSL_VERIFYHOST = false;
        $API_token  = "2c6087138dc7944fafa9f57f4d96bb6a5a2576c308057";
        $phone_from = "556286073728";
        //$phone_to = "556286073728";
        $phone_to   = $chat_id;
        $custom_uid = "msg-converse-".time().rand(5,15);


        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, $CURLOPT_URL); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $CURLOPT_SSL_VERIFYPEER); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, $CURLOPT_SSL_VERIFYHOST); 
        curl_setopt($ch, CURLOPT_POST, 1); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, "token=". $API_token . "&uid=" . $phone_from . "&to=" . $phone_to . "&custom_uid=" . $custom_uid . "&text=" . $text); 
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); 
        curl_setopt($ch, CURLOPT_MAXREDIRS, 5); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($ch, CURLOPT_TIMEOUT, 20); 
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 25); 

        $response = curl_exec($ch); 
        $info = curl_getinfo($ch);
        curl_close ($ch);

        //$message->save();

        return "true";
    }

    public function store_site(Request $request, $chat_id)
    {   
        
        $text = (null !== $request->input('usermsg')) ? $request->input('usermsg') : '';

        $message = new Message();
        $message->user_id = Auth::user()->id;
        $message->chat_id = $chat_id;
        $message->status = 0;
        $message->message = $text;

        $message->save();

        return ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function server($chat_id)
    {
        $messages = DB::select('SELECT * from `messages2` where contact_uid = "'.$chat_id.'"   ORDER BY `created_at` DESC limit 100');
        return response()->json(array('msg' => $messages), 200);
    }


    public function server_chats()
    {
        $phones = User::orderBy("updated_at", "ASC")->get();
        return response()->json(array('phones'=> $phones), 200);
    }

    public function history(Chat $chat, $chat_id)
    {
        $message = new Message();
        $messages = $message->where('chat_id', $chat_id)->get();

        return view('chat.history', ['messages' => $messages]);
    }

    public function show(Chat $chat, $chat_id)
    {
        $user = User::where("phone", $chat_id)
        ->update(['status' => 1]);
        //dd($user);

        return  view('chat.show', [ 
            'chat_id'  => $chat_id
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function edit(Chat $chat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chat $chat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chat $chat)
    {
        //
    }
}
