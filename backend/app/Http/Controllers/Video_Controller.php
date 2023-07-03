<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\videos;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;



class Video_Controller extends Controller
{
    //to create videos

    function create_videos(Request $request){

        $input=$request->all();
        $validation=Validator::make($input,[
            'post_id'=>'required',
            'videos'=>'required'
        ]);
        if($validation->fails()){
            return response()->json(['error'=>$validation->errors()], 422);
        }
        else{
            $user_id= Auth::user()->id;

            if($request->videos && $request->videos->isValid()){
                $file_name=time().'.'.$request->videos->extension();
                $request->videos->move(public_path('videos'),$file_name);
                $path="public/videos/$file_name";

            }


            $videos_db= new videos;
            $videos_db->user_id = $user_id;
            $videos_db->post_id = $request->input('post_id');
            $videos_db->videos = $path;

            $videos_db->save();

            return response()->json(['message'=>"your video added successfuly"], 200);


        }
    }
    //to fetch the video from the database

    function fetch_video($id)
    {
        $user_id = $id;

        if (!$user_id) {

            return response()->json(['error' => "This is not a valid id"], 422);
        } elseif (is_int($user_id)) {

            $video= videos::find($user_id);
        } else {
            $video = videos::where('user_id', $user_id)->first();
        }


        if (!is_null($video)) {
            return response()->json(['user' => $video], 200);
        } else {
            return response()->json(['error' => "This id is not found"], 422);
        }
    }

    //update video

    function update_video(Request $request,$id){

      $input= $request->all();
      $validation= Validator::make($input,[

          'video'=>'required'
      ]);

      if($validation->fails()){
          return response()->json(['error'=>$validation->errors()], 422);
      }
      else{
          $db_result= videos::find($id);
          $db_result->videos= $request['video'];
          $db_result->save();
              return response()->json(['message'=>"Your video successfully updated"], 200);
        }


    }

    //delete comments

    function delete_video($id){

      $delete=videos::find($id);
      if($delete)
      {
          $delete->delete();

          return response()->json(['message'=>"Video deleted successfully"], 200);
      }
      else{
          return response()->json(['error'=>"Invalid Id"], 422);
      }


    }
}
