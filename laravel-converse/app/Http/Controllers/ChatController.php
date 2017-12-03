<?php

namespace App\Http\Controllers;

use App\Chat;
use App\Message;
use Illuminate\Http\Request;
use Auth;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chat = new Chat;
        $chats = $chat::all();


        return  view('chat.index', [
            'chats'    => $chats
        ]);
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
    public function store(Request $request, $chat_id)
    {   
        if(!Auth::user()->id){
            die();
        }
        
        $text = (null !== $request->input('usermsg')) ? $request->input('usermsg') : '';

        //$data = array($id, $_SESSION['name'], stripslashes(htmlspecialchars($text)))

        if ($text === ''){
            return;
        }

        $chat = new Message();

        $chat->user_id = Auth::user()->id;
        $chat->chat_id = $chat_id;
        $chat->status = 0;
        $chat->message = $text;


        if($chat->save()){
            return redirect()->action(
                'ChatController@show',
                ['id' => $chat->chat_id]
            );
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function server(Chat $chat)
    {
        $message = new Message();
        $messages = $message->where('chat_id', $chat->id)->orderby('created_at', 'desc')->get();

        //return response()->json($messages);
        return $messages->toJson();

    }

    public function history(Chat $chat, $chat_id)
    {
        $message = new Message();
        $messages = $message->where('chat_id', $chat_id)->get();

        return view('chat.history', ['messages' => $messages]);

    }

    public function show(Chat $chat, $id)
    {
        $this->middleware('auth');
        if(!Auth::user())
        {
            return redirect('/login?url=chat');
        }

        $methods = new ChatController;

        $chat = new Chat;
        $chats = $chat::all();
        $find_chat = $chat::find($id);


        return  view('chat.show', [
            'messages' => json_decode($methods->server($find_chat)),
            'methods'  => $methods,
            'chat_id'  => $id,
            'chats'    => $chats
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
