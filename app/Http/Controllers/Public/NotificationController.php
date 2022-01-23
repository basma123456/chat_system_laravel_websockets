<?php

namespace App\Http\Controllers\Public;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use App\Events\PrivateOrderShipmentEvent;
use App\Models\User;

class NotificationController extends Controller
{


    public function getNotificationPage(Request $request , $myId)
    {

         $id = $myId;
         return view('notification',['id'=>$id]);

    }

    public function getMyMessage(Request $request)
    {

        if($request->ajax()){
            $msg = $request->message;
          echo  json_encode($msg);
        }
    }
    /**************************************** */

    public function insertMessage(Request $request)
    {
        if($request->ajax()){


        $myAuth = $request->user_id??1;
        // if($request->ajax()){
            $request->validate([
                'message' => 'required',
                'photo' => 'nullable',
                'user_id' => 'required|exists:users,id',
                'receiver_id' => 'required|exists:users,id'   
   
                     ]);


            
            
            $messages = Message::create([
                'message' => $request->message,
                'photo' => $request->photo,
                'user_id' => $myAuth,
                'receiver_id' => $request->receiver_id
    
    
    
            ]);

            return Response::json($messages);
    


        }
    }
    /**************************************** */
    /***************************************** */
    /*************************************** */
    /***************************************** */

    public function getAllUsers(Request $request)
    {

        $users = User::paginate(1);
        $myUser = User::find(Auth::id());
            // return redirect()->back()->with($users);
            return view('get_all_users',['users'=>$users , 'myUser'=>$myUser]);
    }
    /************************************************* */
    public function getMyProfile(Request $request)
    {

        $users = User::all();
        $myUser = User::find(Auth::id());
            // return redirect()->back()->with($users);
            return view('my_profile',['users'=>$users , 'myUser'=>$myUser]);
    }

    /****************************************** */
    public function getNotificationPagePrivate(Request $request,$id)
    {

                $id = $id;
                return view('private_notification',['id'=>$id]);



    }
    /************************************************** */
    public function getMyMessagePrivate(Request $request)
    {
        if($request->ajax()){
            $msg = $request->message;
          echo  json_encode($msg);
        }

    }


    /****************************************************** */
    public function insertMessagePrivate(Request $request)
    {
        if($request->ajax()){


        $myAuth = $request->user_id;
        // if($request->ajax()){
            $request->validate([
                'message' => 'required',
                'photo' => 'nullable',
                'user_id' => 'required|exists:users,id',
                'receiver_id' => 'required|exists:users,id'   
   
                     ]);


            
            
            $messages = Message::create([
                'message' => $request->message,
                'photo' => $request->photo,
                'user_id' => $myAuth,
                'receiver_id' => $request->receiver_id
    
    
    
            ]);

/************************************************** */

            $userId = $request->receiver_id;

            $keyword = $request->message;

            event(new PrivateOrderShipmentEvent($userId,$keyword));
/************************************************************** */
            return Response::json($messages);
    


        }
    }
}
