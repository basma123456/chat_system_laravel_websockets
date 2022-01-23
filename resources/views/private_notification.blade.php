

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


    <link rel="stylesheet" href="{{asset('css/css.css')}}">

</head>
<body>
<!-- <h2>Hi this is the notificationhhhhhhhhhh page </h2> -->
<!-- <div id="div-data"></div> -->
<div class="container">
    <div class="app">
        
                    <header>
                        <h1>Lets Talk</h1>

                        <input type="text" name="username" id="username" value=""  placeholder="Please enter a user name ...." />
                    </header>




                        <div class="text-success" id="div-data"></div>

                            <div id="message_form">
                            <input type="hidden" id="photo" value="" />
                            <input type="hidden" id="receiver_id" value="{{$id}}" />

                            
                                <input type="hidden" name="user_id" id="user_id" value="{{auth()->id()}}" />
                                    <input type="text" class="d-block form-control text-center message" name="message" id="message_input" value="" placeholder="write a message ...." />
                                
                                    <!-- <button type="submit" onclick="getMyMessage()" style="display:block; background-color:red; margin-left:0; position:absolute; left:0;" id="message_sent">Send Message</button> -->
                                    <button type="submit" class="btn btn-primary" onclick="getMyMessage()" style="display:block;" id="message_sent">Send Message</button>
                          

                                </div>

                                
                    
    </div>

    
</div>

<script src="{{asset('js/app.js')}}"></script>
<script>


window.Echo.private("order.{{auth()->id()}}").listen(".order.shipment" , (e)=>{
    console.log(e);
    var hisDiv = document.createElement("div");
    // hisDiv.style.color = "black";
    hisDiv.classList.add("hisMessageClass");
    hisDiv.append(e.message);
    // document.querySelector('#div-data').innerHTML += e.message;
    document.querySelector('#div-data').append(hisDiv);

});

    </script>
    <script>

// $(document).ready(function(){
//     $('#message_sent').onclick(function(){
//         $('#message_form').submit();

//     });
// });

function getMyMessage(){
    // const data = ids;
//  data.forEach(secondFunc);

//    function secondFunc(id){
   let url = "/get_message_private";
//    var linebreak = document.createElement("br");
    var messageHtmlInput =  document.getElementById('message_input');
    var message = document.getElementById('message_input').value;
    
    var myMessageReview = document.getElementById('div-data');
    var divElement = document.createElement("div");
    // divElement.style.color = "blue";
    divElement.classList.add("myMessageClass");

    $.ajax({
        type: "GET",
        url: url,
        // dataType : 'json',
        // response:{'message':message},

        success: function(response){
            var response = JSON.parse(response);

            // alert(message);
            if(message != ''){
            divElement.append(message);
            
            myMessageReview.append(divElement);
            console.log(message);
            messageHtmlInput.value='';
            }
        }
    });
}


/*************************************************************** */
/****************************************************************** */
/******************************************************************* */
/******************************************************************** */

    </script>

<script>
    $(document).ready(function(e1){
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#message_sent").on('click' , function (e) {

        var data = {
      'user_id' : $('#user_id').val(),
      'receiver_id' : $('#receiver_id').val(),
      'message' : $('#message_input').val(),
      'photo' : $('#photo').val(),
      '_method':'POST',
      '_token':'{{ csrf_token() }}',
      
      
    }

// var state = jQuery('#btn-save').val();
var type = "POST";
var ajaxurl = "{{route('message.store.private')}}";
$.ajax({
    type: type,
    enctype:"multipart/form-data",
    url: ajaxurl,
    data: data,
    // processData: false, 
    // contentType: false,
    dataType: 'json',

    success: function (data) {
        // alert('yes');
        // var todo = '<tr id="todo' + data.id + '"><td>' + data.id + '</td><td>' + data.name + '</td><td>' + data.email + '</td>';
        // if (data) {

        //     jQuery('table tbody').prepend(todo);
        // } else {
        //    // jQuery("#todo" + todo_id).replaceWith(todo);
        //    alert('nooooooooo');
        // }
        // jQuery('#myForm').trigger("reset");
        // //jQuery('#formModal').modal('hide')
    },
    error: function (data) {
        alert('noooooo');
    }
});
});

    });

</script>
<!-- /************************** */ -->

    <!-- jQuery library

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

     Latest compiled JavaScript -->

    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> --> 
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> -->








</body>
        

</html>