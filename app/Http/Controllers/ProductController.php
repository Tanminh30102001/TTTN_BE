<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Product::all();
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
        $data=Product::create([
            "name"=>$request->name,
            "quantity"=>$request->quantity,
            "price"=>$request->price,
            "id_nxb"=>$request->id_nxb,
            "id_cat"=>$request->id_cat
        ]);
        return response()->json([
            "message"=>"Add OK !",
            "data"=>$data
        ],200);

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
        $data=Product::find($id);
        return response()->json([
            "message"=>"Data",
            "data"=>$data
        ],200);
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
        $data=Product::find($id);
        if(is_null($data)){
            return response()->json([
                "message"=>"Fail !"
            ]);
        }else{
            $check=Product::all()->where('name',$request->name)->first();
            if(is_null($check)){
                Product::update($request->all());
                return response()->json([
                    "message"=>"Update OK !",
                    "data"=>$check
                ]);
            }else{
                return response()->json([
                    "message"=>"Update Fail !",
                    "data"=>$check
                ]);
            }
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
        $data=Product::find($id);
        if(is_null($data)){
            return response()->json([
                "message"=>"Fail !"
            ]);
        }
        else{
            Product::destroy($id);
            return response()->json([
                "message"=>"Delete OK !"
            ]);
        }
    }
    //

    public function getbycat(Request $request){
        $getIDcat=DB::table('categorys')->select('id')->where('name',$request->name)->get()->value('id');
        $data=Product::all()->where('id_cat',$getIDcat);
        if(is_null($data)){
            return response()->json([
                "data"=>"Not Found !"
            ]);
        }else{
            return response()->json([
                "data"=>$data
            ]);
        }
    }
    public function getbypublisher(Request $request){
        $getID=DB::table('publisher')->select('id')->where('name',$request->name)->get()->value('id');
        $data=Product::all()->where('id_cat',$getID);
        if(is_null($data)){
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
