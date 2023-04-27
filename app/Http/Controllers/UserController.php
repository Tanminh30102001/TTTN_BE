<?php

namespace App\Http\Controllers;

use App\Models\SessionUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return User::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Dang ky -> Cap nhat tai khoan users
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $check=User::find($id);
        if(is_null($check)){
            return response()->json([
                "message"=>"Not Exists !"
            ]);
        }else{

            $check->update($request->all());
            return response()->json([
                "message"=>"Update OK !",
                "data"=>$check
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user=User::find($id);
        if(is_null($user)){
            return response()->json([
                "message"=>"Not Exists !"
            ]);
        }else{
            $user->delete($id);
            return response()->json([
                "message"=>"Delete OK !"
            ]);
        }
    }

    // Register
    public function register(Request $request){
        $data=User::all()->where('name',$request->name)->first();
        if(is_null($data))
        {
            $user=User::create([
                "name"=>$request->name,
                "email"=>$request->email,
                "password"=>bcrypt($request->password)
            ]);
            return response()->json([
                "data"=>$user
            ],200);
        }
        else{
            return response()->json([
                "data"=>"Fail"
            ],200);
        }

    }
    public function login(Request $request)
    {
        $data = [
            "email" => $request->email,
            "password" => $request->password
        ];
        if (auth()->attempt($data)) {
            $checkExist = SessionUser::all()->where("id_us", auth()->id())->first();
            if (is_null($checkExist)) {
                $token = SessionUser::create([
                    "token" => Str::random(40),
                    "refresh_token" => Str::random(40),
                    "token_expried" => date('yY-m-d', strtotime('+30 day')),
                    "refresh_token_expried" => date('yY-m-d', strtotime('+30 day')),
                    "id_us" => auth()->id()
                ]);
            } else {
                $token = $checkExist;
            }
            return response()->json([
                "message" => "Login Sucessfully",
                "data" => $token
            ], 201);
        }
        else{
            return response()->json([
                "message" => "Login Fail",
            ], 201);
        }
    }

    public function logout()
    {
        auth()->logout();
        return response()->json([
            "message" => "Logout Sucessfully"
        ]);
    }
    public function changepass(Request $request){

    }
}
