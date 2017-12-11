@extends('layouts.app')

@section('content')
      
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
      </script>

    
      <div class="col-lg-3">
        <div id='chats'>
            <div id="aux_chats">
            </div>
        </div>
      </div>
      
      
      <div class="col-lg-8">        
        <form name="message" method="post" action="/laravel-converse/chat_post/<?php echo $chat_id;?>">
        {{ csrf_field() }}
        <div class="form-group col-lg-12">
            <div id='msg' class="form-control"><div id="aux"></div></div>
        </div>
        <div class="form-group">
            <div class="col-lg-8">
                <textarea id="usermsg" name="usermsg" class="form-control col-lg-8" rows="2" autocomplete="off" autofocus required></textarea>
            </div>
            <div class="col-lg-4">
                <input name="submitmsg" type="submit" class="form-control col-lg-3" id="submitmsg" value="Enviar" />
            </div>
        </div>
        
        </form>
      </div>

      <script>
        // jQuery Document
        $(document).ready(function() {
            //If user submits the form
            $("#submitmsg").click(function() {
                var clientmsg = $("#usermsg").val();
                $("#usermsg").val('');
                $("#usermsg").focus();
                $.ajax({
                    type: 'POST',
                    url: '/laravel-converse/chat_post/<?php echo $chat_id;?>',
                    data: {
                    "_token": "{{ csrf_token() }}",
                    usermsg: clientmsg
                    },
                    //cache: false,
                    async: true,
                    success: function(data) {
                        if (!isRunLoadLog) {
                            loadLog();
                        }
                    },
                    error: function(request, status, error) {
                        //$("#usermsg").val(clientmsg);
                    },
                });
                return false;
            });

         function getMessage() {
            $.ajax({
               type:'get',
               url:'/laravel-converse/server/<?php echo $chat_id;?>',
               dataType: 'json',
               async: true,
               data:'_token = <?php echo csrf_token() ?>',
               success:function(data) {
                 document.getElementById('aux').remove();
                 var html = '<div id="aux">';
                 for(i=0; i<data.msg.length; i++){

                    if(data.msg[i].message_dir == "o"){
                        data.msg[i].message_dir = "<b>Você disse</b>";
                    }else{
                        data.msg[i].message_dir = "<b>Cliente disse</b>";                        
                    }
                        html = html + "<p>";
                        if(data.msg[i].message_body_url != ""){
                            html = html + data.msg[i].message_dir+ ':<br> <a href="' +data.msg[i].message_body_url+'" target="_blank">IMAGEM</a>\
                            <img src="data:image/png;base64, '+data.msg[i].message_body_thumb+'" />';                   
                        }else{
                            html = html +data.msg[i].message_dir+ ":<br> " +data.msg[i].message;
                            html = html + " <span style='font-size:10px'><i>&nbsp;&nbsp;&nbsp; ("+data.msg[i].created_at+")</i></span>"

                        }
                        html = html + "</p>";
                    
                 }

                 html = html + "</div>";
                 $("#msg").append(html);
               }
            });
         }  
         getMessage();
         setInterval(getMessage, 500);

        function getChats() {
            $.ajax({
               type:'get',
               url:'/laravel-converse/server_chats',               
               dataType: 'json',
               async: true,
               data:'_token = <?php echo csrf_token() ?>',
               success:function(data) {
                 document.getElementById('aux_chats').remove();
                 var html = '<div id="aux_chats">';
                  for(i=0; i<data.phones.length; i++){
                      if(data.phones[i].status == 0){
                          html = html + "<b>";
                      }
                      if(data.phones[i].name == ""){
                        html = html + "<div><a href='/laravel-converse/chat/"+data.phones[i].phone+"'>"+data.phones[i].phone+"</a></br>";                          
                      }else{
                        html = html + "<div><a href='/laravel-converse/chat/"+data.phones[i].phone+"'>"+data.phones[i].name+"</a></br>";
                      }
                      if(data.phones[i].status == 0){
                          html = html + "</b>";
                      }
                 }
                 html = html + "</div>";
                 $("#chats").append(html);
               }
            });
         } 
         getChats();
         setInterval(getChats, 1000);

        });
      </script>


   <style>
   #msg {
    text-align: left;
    margin: 0 auto;
    margin-bottom: 25px;
    padding: 0.5em 1ex 0.1em;
    background: #FEFFF4;
    height: 350px;
    width: 100%;
    white-space: pre;
    word-wrap:  break-word;
    overflow-x:hidden;
    border: 1px solid #C7C7C7;
    overflow-y: auto; 
    }
    textarea{
        overflow-x: hidden;
        resize: none;
    }
    </style>


@endsection