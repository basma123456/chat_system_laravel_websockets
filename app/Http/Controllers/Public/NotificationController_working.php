<?php

namespace App\Http\Controllers\Public;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class NotificationController extends Controller
{


    public function getNotificationPage(Request $request , $myId)
    {

        // dd($myId);
         $id = $myId;
        //  dd($id);
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
    public function getNotificationPagePrivate(Request $request)
    {

        // dd($myId);
        //  dd($id);
        $id = Auth::id();
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

            return Response::json($messages);
    


        }
    }
}
