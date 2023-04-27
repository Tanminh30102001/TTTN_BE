<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Category::all();
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
        $data=Category::all()->where('name',$request->name)->first();
        if(is_null($data)){
            $cat=Category::create([
                "name"=>$request->name
            ]);
            return response()->json([
                "message"=>"Add OK !",
                "data"=>$cat
            ],200);
        }else{
            return response()->json([
                "message"=>"Existed !",
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
        $data=Category::find($id);
        if(is_null($data)){
            return response()->json([
                "message"=>"Null !",
                "data"=>$data
            ],200);
        }else{
            return response()->json([
                "data"=>$data
            ],200);
        }
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
        $data=Category::all()->where('name',$request->name)->first();
        if(is_null($data)){
            $data->update($request->all());
            return response()->json([
                "message"=>"Update OK !",
                "data"=>$data
            ],200);
        }else{
            return response()->json([
                "message"=>"Exists !",
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
        $data=Category::find($id);
        if(is_null($data)){
            return response()->json([
                "message"=>"Null !",
                "data"=>$data
            ],200);
        }else{
            $data->delete($id);
            return response()->json([
                "message"=>"Delete OK !",
                "data"=>$data
            ],200);
        }

    }
}
