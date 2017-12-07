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

        $phones = DB::select('SELECT DISTINCT contact_uid FROM messages ORDER BY `created_at` DESC');
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

        
        $msg = new Message();    

        $msg->message       = $message["body"]["text"];
        $msg->event         = $event;            
        $msg->token         = $token;            
        $msg->contact_uid   = $contact["uid"];            
        $msg->contact_name  = $contact["name"];            
        $msg->contact_type  = $contact["type"];            
        $msg->message_dtm   = $message["dtm"];            
        $msg->message_uid   = $message["uid"];            
        $msg->message_cuid  = $message["cuid"];            
        $msg->message_dir   = $message["dir"];            
        $msg->message_type  = $message["type"];            
        $msg->message_ack   = $message["ack"];

        $msg2 = new Message2();
        $msg2 = $msg;
        $msg2->save();

        $user = new User();
        $find_user = $user::where("phone", $msg->contact_uid)->get();

        if(!isset($find_user[0])){
            $user->name = $contact["name"];
            $user->phone = $msg->contact_uid;
            $user->email = "";
            $user->type = $msg->contact_type;

            if($user->save()){
                $msg->user_id = $user->id;                
            }
        } else {
            $msg->user_id = $find_user[0]->id;
        }

        $chat = new Chat();
        $find_chat = $chat::where("user_id", $msg->user_id)->get();

        //dd(isset($find_chat[0]));

        if(!isset($find_chat[0])){
            $chat->user_id = $msg->user_id;
            $chat->phone_user = $msg->contact_uid;
            $chat->setor = 1;
            $chat->canal = 1;
            $chat->status = 0;

            if($chat->save()){
                $msg->chat_id = $chat->id;                
            }
        } else {
            $msg->chat_id = $find_chat[0]->id;
        }
        
        $msg->save();
        
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

/*
    public function wpp_receive(){

        $event = $_POST["event"];
        $token = $_POST["token"];
        $contact = $_POST["contact"];
        $message = $_POST["message"];
        
        $chat = new Message();

        //$chat->message =    $event . "<br>" .
        //                    $token . "<br>" .
        //                    $contact  . "<br>" .
        //                    $message["body"];
        
        $chat->message =   $_POST["message"]["body"];
                            
        
        $chat->user_id = 2222;
        $chat->chat_id = 1;
        $chat->status = 0;

        $chat->save();
        return "true";          
    }
*/

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_wpp(Request $request, $chat_id)
    {   
        if(!Auth::user()->id){
            die();
        }
        
        $text = (null !== $request->input('usermsg')) ? $request->input('usermsg') : '';

        //$data = array($id, $_SESSION['name'], stripslashes(htmlspecialchars($text)))

        if ($text === ''){
            return;
        }

        $chat = new Chat();
        $find_chat = $chat::where("id", $chat_id)->get();
        $phone_user = $find_chat[0]->phone_user;

        $message = new Message();
        $message->user_id = Auth::user()->id;
        $message->chat_id = $chat_id;
        $message->status = 0;
        $message->message = $text;

            
        $CURLOPT_URL = "https://www.waboxapp.com/api/send/chat";
        $CURLOPT_SSL_VERIFYPEER =  false;
        $CURLOPT_SSL_VERIFYHOST = false;
        $API_token  = "e8ad314e8f9922edf98eeda27d79d8725a2574c4da8fb";
        $phone_from = "556286073728";
        //$phone_to = "556286073728";
        $phone_to   = $phone_user;
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
        
        //dd($response);
        //$text = json_encode($response);
        //$text = json_decode($response);
        //dd($text->error);
        /*
        $msg2 = new Message2();
        if( isset($text->success) ){
            $msg->status = $text->success;
        }
        if( isset($text->error) ){
            $msg->error = $text->error;
        }
        if( isset($text->custom_uid) ){
            $msg->custom_id = $text->custom_uid;
        }
        $msg2->save();
        */

        $message->save();

        return ;
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
    public function server(Chat $chat = null)
    {
        if( $chat !== null ){
            $message = new Message();
            $messages = $message->where('chat_id', $chat->id)->orderby('created_at', 'desc')->get();

            //return response()->json($messages);
            //return json_decode( $messages->toJson());
            return response()->json(array('msg'=> $messages), 200);
        }
    }

    public function history(Chat $chat, $chat_id)
    {
        $message = new Message();
        $messages = $message->where('chat_id', $chat_id)->get();

        return view('chat.history', ['messages' => $messages]);

    }

    public function show(Chat $chat, $id)
    {

        $phones = DB::select('SELECT DISTINCT contact_uid FROM messages ORDER BY `created_at` DESC');
        
        $this->middleware('auth');
        if(!Auth::user())
        {
            return redirect('/login?url=chat');
        }

        $methods = new ChatController;

        //Tenho que remover isso e deixar apenas o distinct
        $chat = new Chat;
        $chats = $chat::all();
        $find_chat = $chat::find($id);

        return  view('chat.show', [
            'messages' => $methods->server($find_chat),
            'methods'  => $methods,
            'chat_id'  => $id,
            'chats'    => $phones
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
