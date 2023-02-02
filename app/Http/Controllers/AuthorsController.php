<?php

namespace App\Http\Controllers;

use App\Models\Authors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AuthorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
      //validate

        $request->validate([
            "name"=> "required",
            "email"=> "required|email|unique:authors",
            "password"=> "required|confirmed",
            "phone_no"=> "required"
        ]);

        // save to database
        DB::table('authors')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone_no' => $request->phone_no,
        ]);

        //json response

        return response([
            "status" =>1,
            "messagae" => "Author Created"
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // LOGIN METHOD - POST
    public function login(Request $request)
    {
        // validation
        $login_data = $request->validate([
            "email" => "required",
            "password" => "required"
        ]);

        // validate author data
        if(!auth()->attempt($login_data)){

            return response()->json([
                "status" => false,
                "message" => "Invalid Credentials"
            ]);
        }

        // token
        $token = auth()->user()->createToken("auth_token")->accessToken;

        // send response
        return response()->json([
            "status" => true,
            "message" => "Author Logged in successfully",
            "access_token" => $token
        ]);
    }

    public function profile()
    {
        $user_data = auth()->user();

        return response()->json([
            "status" => true,
            "message" => "User Data",
            "data" => $user_data
        ]);
    }
    public function logout(Request $request)
    {
        $token = $request->user()->token();

        $token->revoke();

        return response()->json([
            "status" => true,
            "message" => "Logout Succesfully"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Authors  $authors
     * @return \Illuminate\Http\Response
     */
    public function show(Authors $authors)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Authors  $authors
     * @return \Illuminate\Http\Response
     */
    public function edit(Authors $authors)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Authors  $authors
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Authors $authors)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Authors  $authors
     * @return \Illuminate\Http\Response
     */
    public function destroy(Authors $authors)
    {
        //
    }
}
