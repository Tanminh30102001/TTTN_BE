<?php

namespace App\Http\Controllers;

use App\Models\Pulisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Pulisher::all();
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
        $check=Pulisher::all()->where('name',$request->name)->first();
        if(is_null($check))
        {
            $pubs=Pulisher::create([
                "name"=>$request->name
            ]);
            return response()->json([
                "message"=>"Add OK !",
                "data"=>$pubs
            ],200);
        }else{
            return response()->json([
                "message"=>"Fail !",
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
        $find=Pulisher::find($id);
        if(is_null($find)){
            $data=Pulisher::all()->where('name',$request->name)->first();
            if(is_null($data)){
                $data->update($request->all());
                return response()->json([
                    "message"=>"Update OK !",
                    "data"=>$data
                ]);
            }else{
                return response()->json([
                    "message"=>"Update Fail !"
                ]);
            }
        }else{
            return response()->json([
                "message"=>"Update Fail !"
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
        $find=Pulisher::find($id);
        if(is_null($find)) {
            return response()->json([
                "message"=>"Delete Fail !"
            ]);
        }else{
            Pulisher::destroy($id);
            return response()->json([
                "message"=>"Delete OK !"
            ]);
        }
    }
}
