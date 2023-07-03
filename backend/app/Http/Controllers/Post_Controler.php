<?php

namespace App\Http\Controllers;

use App\Models\comments;
use Illuminate\Http\Request;
use App\Models\post;
use App\Models\videos;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Post_Controler extends Controller
{
    public function create_post(Request $request)
    {

        $user_id = Auth::user()->id;

        $input = $request->all();
        $validation = Validator::make($input, [
            'cat_id' => 'required',
            'title' => 'required',
            'full_img' => 'nullable|image',
            // 'video' => 'nullable|file|mimetypes:video',
            'detail' => 'required',
            'tags' => 'required'


        ]);
        if ($validation->fails()) {
            return response()->json(['error' => $validation->errors()], 200,);
        } else {

            if ($request->full_img && $request->full_img->isValid()) {
                $file_name = time() . '.' . $request->full_img->extension();
                $request->full_img->move(public_path('images'), $file_name);
                $path = "public/images/$file_name";
            }
            //for video storage
            if ($request->video && $request->video->isValid()) {
                $file_name = $request->video->getClientOriginalName();
                $request->video->move(public_path('videos'), $file_name);
                $video_path = "public/videos/$file_name";

                $videos_db = new videos;

                //to be


            }

            $post_db = new post;

            $post_db->id = $user_id;
            $post_db->cat_id = $request->input('cat_id');
            $post_db->title = $request->input('title');
            $post_db->full_img = "/images/$file_name";
            $post_db->video = "/images/$file_name";


            $post_db->detail = $request->input('detail');
            $post_db->tags = $request->input('tags');


            $post_db->save();
            return response()->json($input, 200,);
        }
    }

    //to fetch the data from the database

    function fetch_Data($id)
    {
        if ($id) {
            //  $posts = post::find($id);
            $posts=post::where('post_id',$id)->get();

        }

        if($posts){
            return response()->json(['posts' => $posts], 200);
        }
        else{
            return response()->json(['error' => "This id is not found"], 422);
        }



        // $user_id = $id;

        // if (!$user_id) {

        //     return response()->json(['error' => "This is not a valid id"], 422);
        // } elseif (is_int($user_id)) {

        //     $post_details = post::find($user_id);
        // } else {
        //     $post_details = post::where('id', $user_id)->get();
        // }


        // if (!is_null($post_details)) {
        //
        // } else {
        //     return response()->json(['error' => "This id is not found"], 422);
        // }
    }

    // to fetch all posts
    function all_posts(){
        // $posts=DB::select('select * from posts');
        $posts=post::get();
        return response()->json(['posts'=>$posts], 200);
    }

    // function get_usrespost(){
    //     // dd(Auth::user()->id);
    //     // exit;

    //     $user_id=Auth::user()->id;
    //     $posts= post::where('id',$user_id)->get_user_posts;
    //     return response()->json(['user' => $posts], 200);
    //     // dd($posts);
    //     // exit;




    // }

    //update post starts
    function update_post(Request $request, $id)
    {

        // dd($request,$id);

        $validation = Validator::make($request->all(), [

            'title' => 'required'

        ]);
        if ($validation->fails()) {
            return response()->json(['error' => $validation->errors()], 422);
        } else {


            $update_post = post::find($id);
            $update_post->title = $request['title'];
            $update_post->save();

            // $update_post->title = $input->update();
            // $update_post->save();

            return response()->json(['message' => "Successfully updated"], 200,);

            // $update = post::where('title',$input)->update($input);


        }
    }

    //delete post
    function detele_post($id)
    {

        $delete = post::find($id);
        if ($delete) {
            $delete->delete();
            return response()->json(['message' => "Success"], 200);
        } else {
            return response()->json(['error' => "Id not found"], 422);
        }
    }

    //showing post with comments

    function show_comments($id)
    {

        // $comments = post::find($id)->get_comments;
        $comments= comments::where('post_id',$id)->with('user')->get();


        return response()->json(['user' => $comments], 200);
    }
}
