<?php

namespace App\Http\Controllers;

use App\Models\DetailsOder;
use App\Models\Oder;
use App\Models\SessionUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Oder::all();
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
        //
        $token=$request->header('token');
        $check=SessionUser::all()->where('token',$token)->first();
        $us_id=DB::table('session_users')->select('id_us')->where('token',$token)->get()->value('id_us');
        if(is_null($token))
        {
            return response()->json([
                "message"=>"Fails token"
            ],401);
        }elseif (is_null($check)){
            return response()->json([
                "message"=>"Fails token"
            ],401);
        }else{
            $oder=Oder::create([
                "date"=>date('yY-m-d',strtotime('+30 day')),
                "condition"=>$request->condition,
                "id_us"=>$us_id
            ]);
            $details=DetailsOder::create([
                "quantity"=>$request->quantity,
                "payment"=>$request->payment,
                "delivery"=>$request->delivery,
                "id_prd"=>$request->id_prd,
                "id_oders"=>$oder->get()->value('id')
            ]);
            return response()->json([
                "data"=>[
                    "oders"=>$oder,
                    "details"=>$details
                ]
            ],200);
        }
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
        $checkexists=Oder::find($id);
        $token=$request->header('token');
        $check=SessionUser::all()->where('token',$token)->first();
        if(is_null($token))
        {
            return response()->json([
                "message"=>"Fails token"
            ],401);
        }elseif (is_null($check)){
            return response()->json([
                "message"=>"Fails token"
            ],401);
        }
        if(is_null($checkexists)){
            return response()->json([
                "message"=>"Fail !"
            ],200);
        }else{
            $data =Oder::update($request->all());
            return response()->json([
                "message"=>"Update OK !",
                "data"=>$data
            ],200);
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
    }

    //get by user name
    public function getbyusername(Request $request){
        $getUserID=DB::table('users')->select('id')->where('name',$request->name)->get()->value('id');
        $data=Oder::all()->where('id_us',$getUserID);
        if (is_null($data)){
            return response()->json([
                "data"=>"Not Found !"
            ]);
        }else{
            return response()->json([
                "data"=>$data
            ]);
        }
    }
}
