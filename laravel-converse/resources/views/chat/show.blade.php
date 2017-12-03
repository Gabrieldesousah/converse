@extends('layouts.app')

@section('content')

        <link type="text/css" rel="stylesheet" href="{{ asset('css/chat.css') }}" />
        <link type="text/css" rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" />

<br><br><br>
        <div class="col-lg-3" style="margin: 2% auto;">
            @foreach($chats as $c)
                <a href="{{ $c->id }}">Chat {{ $c->id }} criado por {{ $c->user_id }}</a>
                <br>
            @endforeach
        </div>
        

        <div id="wrapper" class="col-lg-9">
            <div id="menu">
                <p class="welcome">Welcome, <b>{{ Auth::user()->name }}</b></p>
                <p class="logout"><a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                                    Logout
                                </a></p>
                
                <p class="logout" style="margin-right: 1em;"><a target="_blank" href="history/{{ $chat_id }}">History</a></p>
                <div style="clear:both"></div>
            </div>

            <div id="chatbox">
                <table>
                @foreach($messages as $m)
                    <tr>
                        <td>{{ $m->user_id }}</td>
                        <td>{{ $m->message }}</td>
                    </tr>
                @endforeach
                </table>
            </div>

            <form name="message" action="" method="post">
            {{ csrf_field() }}
                <input name="usermsg" type="text" id="usermsg" size="63" autocomplete="off" autofocus />
                <input name="submitmsg" type="submit"  id="submitmsg" value="Send" />
            </form>
        </div>


        <!--script type="text/javascript" src="jquery.min.js"></script-->
        <script src="{{ asset('js/jquery.js') }}"></script>
        <!--script type="text/javascript">
            // jQuery Document
            $(document).ready(function() {
                var id = 'undefined';
                var oldId = null;
                var isRunLoadLog = false;
                //If user submits the form
                $("#submitmsg").click(function() {
                    var clientmsg = $("#usermsg").val();
                    $("#usermsg").val('');
                    $("#usermsg").focus();
                    $.ajax({
                        type: 'POST',
                        url: 'http://127.0.0.1/laravel-converse/public/chat/store',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            text: clientmsg
                        },
                        //cache: false,
                        async: true,
                        success: function(data) {
                            if (!isRunLoadLog) {
                                loadLog();
                            }
                        },
                        error: function(request, status, error) {
                            $("#usermsg").val(clientmsg);
                        },
                    });
                    return false;
                });

                //Load the file containing the chat log
                function loadLog() {
                    isRunLoadLog = true;
                    var oldscrollHeight = $("#chatbox")[0].scrollHeight;
                    $.ajax({
                        type: 'POST',
                        url: 'http://127.0.0.1/laravel-converse/public/chat/server',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            id: id
                        },
                        dataType: 'json',
                        //cache: false,
                        async: true,
                        success: function(data) {
                            id = data.id;
                            if (oldId !== id) {
                                oldId = id;
                                var html = 'teste';
                                var date;
                                /*for (var k in data.data.reverse()) {
                                        date = new Date(parseInt(data.data[k][0])*1000);
                                        date = date.toLocaleTimeString();
                                        date = date.replace(/([\d]+\D+[\d]{2})\D+[\d]{2}(.*)/, '$1$2');
                                        html = html
                                                +"<div class='msgln'>("+date+") <b>"
                                                +data.data[k][1]+"</b>: "+data.data[k][2]+"<br></div>";
                                }*/
                                $("#chatbox").append(html); //Insert chat messages into the #chatbox div
                                var newscrollHeight = $("#chatbox")[0].scrollHeight;
                                if (newscrollHeight > oldscrollHeight) {
                                    $("#chatbox").scrollTop($("#chatbox")[0].scrollHeight);
                                }    
                            }
                            isRunLoadLog = false;
                        },
                    });
                }
                loadLog();
                setInterval(loadLog, 2500);	//Reload file every 2.5 seconds

                //If user wants to end session
                $("#exit").click(function() {
                    var exit = confirm("Are you sure you want to end the session?");
                    if (exit == true) {
                        window.location = 'index.php?logout=true';
                    }
                });
            });
        </script-->

</body>
</html>


@endsection