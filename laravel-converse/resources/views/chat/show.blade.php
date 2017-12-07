<html>
   <head>
      <title>Ajax Example</title>
      
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
      </script>
      {{ $chat_id }}
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
                    url: '/converse/laravel-converse/chat/<?php echo $chat_id;?>',
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
                        $("#usermsg").val(clientmsg);
                    },
                });
                return false;
            });

         function getMessage() {
            $.ajax({
               type:'get',
               url:'/converse/laravel-converse/server/<?php echo $chat_id;?>',
               dataType: 'json',
               async: true,
               data:'_token = <?php echo csrf_token() ?>',
               success:function(data) {
                 document.getElementById('aux').remove();
                 var html = '<div id="aux">';
                 for(i=0; i<data.msg.length; i++){
                    html = html + "<tr>";
                    html = html + "<td>" +data.msg[i].message+"<br></td>";
                    html = html + "</tr>";
                 }
                 html = html + "</div>";
                 $("#msg").append(html);
               }
            });
         }  
         getMessage();
         setInterval(getMessage, 100);

        });
      </script>
   </head>
   <style>
   #msg {
    text-align: left;
    margin: 0 auto;
    margin-bottom: 25px;
    padding: 0.5em 1ex 0.1em;
    background: #FEFFF4;
    height: 75%;
    width: 90%;
    border: 1px solid #C7C7C7;
    overflow: auto; }
    </style>
   <body>
      <div id='msg'>
        <div id="aux">
        </div>
      </div>
      
      <form name="message" method="post" action="/laravel-chat/chat/<?php echo $chat_id;?>">
      {{ csrf_field() }}
        <input name="usermsg" type="text" id="usermsg" size="63" autocomplete="off" autofocus />
        <input name="submitmsg" type="submit"  id="submitmsg" value="Send" />
      </form>
   </body>

</html>