<html>
   <head>
      <title>Ajax Example</title>
      
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
      </script>
      
      <script>
         function getMessage() {
           //var oldscrollHeight = $("#msg").textContext;
           
            $.ajax({
               type:'get',
               url:'getmsg',
               dataType: 'json',
               async: true,
               data:'_token = <?php echo csrf_token() ?>',
               success:function(data) {
                 document.getElementById('aux').remove();
                 var html = '<div id="aux">';
                 for(i=0; i<data.msg.length; i++){
                    html = html + "<div class='msgln'>" +data.msg[i]+"<br></div>";
                 }
                 html = html + "</div>";
                 $("#msg").append(html);
               }
            });
         }  
         getMessage();
         setInterval(getMessage, 2000);
          
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
      <button onClick='getMessage()'>Refresh</button>
   </body>

</html>