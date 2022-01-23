<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class MyProfileController extends Controller
{

    use ImageTrait;

    
    public function update( $id , Request $request)
    {


        $request->validate([

            'info' => 'nullable|string'
        ]);


        $user = User::find($id);
            if($user){
                    $user->info = $request->info;

                $savedAction =    $user->update();
                 if($savedAction){
                    return Response::json(['user'=>$user , 'status'=>200 , 'msg'=>'Congratulation, you have updated this record successfully']);
           }else{
            return Response::json(['status'=>400 , 'msg'=>'no, you have not updated this record successfully']);
    
           }
                    //  }else{
                  //  return Response::json(['status'=>400 , 'msg'=>'Sorry, you have not updated this record']);
    
    //             }
            
               }
    }

    /**************************************************************** */



   public function changeProfilePhoto($id , Request $request)
   {
            // $id = $request->myId;
    if($request->my_photo != null){

     $myFileName = $this->saveImage($request->my_photo , 'photos/users_photos');

        //insert
        $user = User::find($id);
        if($user){
            $user->photo = $myFileName;
            $user->save();
        }

        return redirect()->back()->with('msg','congratulation for your new photo');
    }else{
        return redirect()->back();
    }
   }



}
