@extends('layouts/master')



@section('content')
<div class="container container-face" style="margin-top:30px;">

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

</div>
<div class="mt-5 text-left margin-auto d-flex justify-content-center">
                {!! $users->links() !!}
  </div>

@endsection