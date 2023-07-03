<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class UserLoginController extends Controller
{
    function userLogin(Request $request){

        return $request-> input();

    }
}
