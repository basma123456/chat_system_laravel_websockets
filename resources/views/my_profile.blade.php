
@extends('layouts/master')



@section('content')
<div class="container container-face" style="margin-top:30px;">

@if(Session::has('msg'))
    <div class="alert alert-success">
        {{ Session::get('msg') }}
    </div>
    @endif

    @if(Session::has('msg'))
    @php 
    Session::forget('msg'); 
    @endphp
    @endif

  <div class="row">
      <div class="col-12 bk-user">
            <div class="text-center offset-sm-4 col-sm-4">
            <h2><b>{{$myUser->name}}</b></h2>
            <div class="text-center fakeimg fakeimg_profile">
              
              <form id="upload_image_form" method="post" action="{{route('change.profile.photo',auth()->id())}}" enctype="multipart/form-data" >
                @csrf
                @if(isset($myUser))
                      <!-- <input type="hidden" value="{{auth()->id()}}" name='myId'> -->
                      @if($myUser->photo != null)
                      <img src="{{asset('photos/users_photos/')}}/{{$myUser->photo}}"  width="290" height="290" />
                      @elseif($myUser->photo == null && $myUser->gender == 1)
                      <img src="{{asset('photos/users_photos/')}}/man_avatar.png"  width="290" height="290" />
                      @elseif($myUser->photo == null && $myUser->gender == 2)
                      <img src="{{asset('photos/users_photos/')}}/woman_avatar.png"   width="290" height="290"/>
                      @endif

                      <input type="file" name="my_photo" id="my_photo_input_id" class="upload_image_class" value="{{$myUser->photo??null}}" />
                @endif
                    <input type="submit" id="upload_image_submit" class="upload_image_class" value="upload image"  />
              </form>
            </div>
            <!-- <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                <a class="nav-link active" href="#">Active</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                <a class="nav-link disabled" href="#">Disabled</a>
                </li>
            </ul> -->
            <hr class="d-sm-none">
            </div>
      </div>
    <div class="col-sm-12">
      <!-- <h2>TITLE HEADING</h2> -->
      <br><br>
      <div class="fakeimg">

      <nav class="navbar navbar-expand-sm bg-light navbar-light">
  <!-- <a class="navbar-brand" href="#">Navbar</a> -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav col-12">
    <li class="nav-item col-3">
      <a onclick="myFunction()" class="dropbtn nav-link btn btn-light">Dropdown</a>

      </li>  

      <li class="nav-item col-3">
        <a class="nav-link btn btn-light" href="{{url('get_users')}}">All Users</a>
      </li>
      <li class="nav-item col-3">
        <button type="button" class="btn btn-light btn-lg" data-toggle="modal" data-target="#myModal">About Me</button>      </li>
      <li class="nav-item col-3">
        <a class="nav-link btn btn-light" href="#">Link</a>
      </li>  
    </ul>
  </div>  
</nav>


      <!-- /////////////////////////////info div////////////////////////////////// -->




      <!-- //////////////////////////////////end info div/////////////////////////////// -->

                      <!--/////////////////////////////////////////////////////-->

                <div class="dropdown">
                                <!-- <button onclick="myFunction()" class="dropbtn">Dropdown</button> -->
                            <div id="myDropdown" class="dropdown-content">
                                @if($users)
                                @foreach($users as $user)
                                        @if( $user->gender === '1' && $user->photo == null)
                                            <a href="{{url('/get_page_private/')}}/{{$user->id}}">{{$user->name}}
                                                <br>
                                            <img src="{{asset('photos/users_photos/man_avatar.png')}}" width="100" height="100" />
                                            </a>
                                        @elseif( $user->gender === '2' && $user->photo == null)
                                                <a href="{{url('/get_page_private/')}}/{{$user->id}}">{{$user->name}}
                                                <br>
                                            <img src="{{asset('photos/users_photos/woman_avatar.png')}}" width="100" height="100" />
                                            </a>
                                        @elseif($user->photo != null)
                                                <a href="{{url('/get_page_private/')}}/{{$user->id}}">{{$user->name}}
                                                <br>
                                            <!-- <img src="{{asset('photos/users_photos/')}}/{{$user->photo}}" width="100" height="100" /> -->
                                            
                                                <img src="{{asset('photos/users_photos/')}}/{{$user->photo}}" width="100" height="100" />

                                            </a>
                                        @endif
                                    @endforeach
                                @endif

                            </div> <!--id="myDropdown" class="dropdown-content" -->
                </div> <!--dropdown-->

      </div>
      <br>













    </div>
  </div>
</div>
<!-------------------------start modal----------------------->
 <!-- Modal -->
 <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content gray_color_info_modal">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class="info_modal_body">
          <p>Edit Here : </p>

                <form id="info_form">
                {{ method_field('PATCH') }}
                @csrf

                <input type="hidden" name="remeber_token" id="csrf" value="{{Session::token()}}">

               <input type="hidden" id='update_info_id' value="{{$myUser->id}}" />

                  <input id="my_info_input" class="border" type="text" value="{{$myUser->info??null}}" /> 
                  <input type="submit" class="my_info_input_submit d-inline btn btn-secondary btn-sm text-center mt-1" id="my_info_submit" value="submit">
                
                </form>
<br>
                <hr>
                <div id="info_showed" class="infoStyle text-center">
        {{$myUser->info??null}}
        </div> <!--info_modal_body-->
      </div> <!-- modal-body-->


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<!--------------------------end modal----------------------------->




<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>
<!-- /////////////////ajax post part/////////////// -->
<script>

 /****************************start of update section********** */   

 $('#info_form').submit( function(e){



e.preventDefault();

var info_showed = document.getElementById('info_showed');
var user_id = $('#update_info_id').val();
var url = "users/"+user_id ;
var data = {
  'id' : user_id,
  'info' : $('#my_info_input').val(),
  '_method':'PATCH',
  '_token':'{{ csrf_token() }}',
  
  
}

$.ajax({

  type: 'PUT',
  cache: false,
    url: url,
    data : data ,
    dataType : 'json',

    success : function(response){

      if(response.status === 200){
          //   $('#msg').html("");

              
          //   $('#msg').addClass('alert alert-success');
          //   $('#msg').text(response.msg);
          //   $('#updateModal').modal('hide');
          // var myButtons = '<a data-id="' +  response.user.id  + '" id="edit_user" class="btn btn-primary btnEdit">Edit</a> <a data-id="'+ response.user.id +'" class="btn btn-danger btnDelete">Delete</button>';

          // var todo2 = '<tr id="todo' + response.user.id + '"><td>' + response.user.id + '</td><td>' + response.user.name + '</td><td>' + response.user.email + '</td> <td>'+ myButtons +'</td>';

          if(response){
            info_showed.innerText = response.user.info;

            alert('Congratulations, Information About You Have Been Updated Successfully');
              //   jQuery('table tbody #todo'+ response.user.id).replaceWith(todo2);
              // // jQuery('table tbody #todo2').append(todo2);
            console.log(response);
          }
      }else{//if(response.status===200)
          // $('#msg').html("");                  
          // $('#msg').addClass('alert alert-danger');
          // $('#msg').text(response.msg);
          // $('#updateModal').modal('hide');
          alert('noooooooooooooooooooo');

        
//here
      }
  
  },
    error: function (reject) { //herehere

      var response = $.parseJSON(reject.responseText);

      $.each(response.errors , function(key , val){
        $('#'+key+'_error').text(val[0]);
      });
    }
});

});
/***************************end of update section************ */  
</script>
<!-- //////////////////ajax end post part////////////////// -->
@endsection