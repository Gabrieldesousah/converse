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

      <script>
       // jQuery Document
        $(document).ready(function() {
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
@endsection