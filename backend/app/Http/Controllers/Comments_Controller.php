<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\comments;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class Comments_Controller extends Controller
{
    function create_comments(Request $request){

        $user_id = Auth::user()->id;

        $input = $request->all();
        $validation = Validator::make($input, [
            'post_id' => 'required',
            'comment' => 'required'


        ]);
        if ($validation->fails()) {
            return response()->json(['error' => $validation->errors()], 200,);
        } else {

            $post_db = new comments;

            $post_db->id = $user_id;
            $post_db->post_id = $request->input('post_id');
            $post_db->comment = $request->input('comment');


            $post_db->save();

            return response()->json($input, 200,);
        }

    }

      //to fetch the data from the database

      function fetch_comment($id)
      {
          $post_id = $id;

          if (!$post_id) {

            return response()->json(['error' => "This is not a valid id"], 422);

        } elseif (is_int($post_id)) {


              $coment_details = comments::find($post_id);


          } else {
              $coment_details = comments::where('post_id', $post_id)->first();
              dd($coment_details);
              exit;
          }


          if (!$coment_details) {
              return response()->json(['user' => $coment_details], 200);
          } else {
              return response()->json(['error' => "This id is not found"], 422);
          }
      }

      //update comments

      function update_comments(Request $request,$id){

        $input= $request->all();
        $validation= Validator::make($input,[

            'comments'=>'required'
        ]);

        if($validation->fails()){
            return response()->json(['error'=>$validation->errors()], 422);
        }
        else{
            $db_result= comments::find($id);
            $db_result->comment= $request['comments'];
            $db_result->save();
            if($db_result->success()){
                return response()->json(['message'=>"Your Comment successfully updated"], 200);
            }
            else{
                return response()->json(['error'=>"Failed to Update check your code again"], 422);


            }
        }

      }

      //delete comments

      function delete_comment($id){

        $delete=comments::find($id);
        if($delete)
        {
            $delete->delete();

            return response()->json(['message'=>"Comment deleted successfully"], 200);
        }
        else{
            return response()->json(['error'=>"Invalid Id"], 422);
        }


      }


}
