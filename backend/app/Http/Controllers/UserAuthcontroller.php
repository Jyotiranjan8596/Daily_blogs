<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\isNull;

class UserAuthcontroller extends Controller
{
    function getData($id)
    {
        if (!$id) {

            return response()->json(['error' => "This is not a valid id"], 422);
        } elseif (is_int($id)) {

            $user_details = User::find($id);
        } else {
            $user_details = User::where('name', $id)->first();
        }
        if (!is_null($user_details)) {
            return response()->json(['user' => $user_details], 200);
        } else {
            return response()->json(['error' => "This id is not found"], 422);
        }
    }

    public function register(Request $request)
    {

        $input = $request->all();
        $validation = Validator::make($input, [
            'name' => 'required',
            'email' => 'required | email',
            'password' => 'required | min:8',
        ]);
        //    dd($validation->fails());

        if ($validation->fails()) {

            return response()->json(['error' => $validation->errors()], 422);
        } else {
            $user = User::create($input);
            $tokan = $user->createToken('Signup_Token')->accessToken;
            return response()->json([

                'token' => $tokan,
                'user' => $user,
                'status' => 'Success'

            ], 200,);
        }
    }
    //for forgot password
    function forgotPassword(Request $request)
    {

        $input = $request->all();

        $validation = Validator::make($input, [
            'email' => 'required',
            'password' => 'required'
        ]);


        $user = User::where('email', $input['email'])->first();

        //    dd($user);
        //    exit;
        // dd( $user['email']);
        if ($user) {

            $user->password = $input['password'];

            $user->save();
            return response()->json(['user' => "Password Updated Successfully"], 200);
        }
        else {
            return response()->json(['error' => $user->errors()], 422);
        }

        //hash method to get the password


    }


    //for login the user

    function login(Request $request)
    {
        $input = $request->all();

        $validation = Validator::make($input, [
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validation->fails()) {
            // dd("Validation failed");
            return response()->json(['error' => $validation->errors()], 422,);
        } else {

            $user = User::where(['email' => $input['email'], 'password' => $input['password']])->first();
            // dd($user);

           if($user){
            $token = $user->createToken('Login_Token')->accessToken;
            return response()->json([
                'token' => $token,
                'user' => $user
            ], 200,);
           }
           else{
            return response()->json(['error'=>"Invalid Data"]);
           }
        }
    }

    function show_post($id)
    {

        $posts = User::find($id)->get_user_posts;
        return response()->json(['user' => $posts], 200);

        // $data=User::with('get_user_posts')->get();
        // return response()->json(['user'=>$data], 200);

    }
}
