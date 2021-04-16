<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Model_thanh_pho;
use App\Models\Model_quan;
use App\Models\Model_phuong;
use App\Models\Model_duong;

class Controller_dia_chi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }
    public function lay_thanh_pho($thanh_pho = null, $quan = null)
    {
        $result = Model_thanh_pho::get();
        if ($thanh_pho && !$quan) {
            $result =  Model_quan::where("_province_id", $thanh_pho)->get();
            return response()->json(["status" => "success", "quan" => $result]);
        } else if ($thanh_pho && $quan) {
            $result =  Model_phuong::where("_province_id", $thanh_pho)->where("_district_id", $quan)->get();
            $result2 =  Model_duong::where("_province_id", $thanh_pho)->where("_district_id", $quan)->get();
            return response()->json(["status" => "success", "phuong" => $result, "duong" => $result2]);
        } else {
            return response()->json(["status" => "success", "thanh_pho" => $result]);
        }
    }
    // public function lay_quan_tu_thanh_pho($id_tp)
    // {
    //     Model_quan::where("_province_id", $id_tp)->get();
    // }
    // public function lay_phuong_tu_quan_va_thanh_pho($id_tp, $id_quan)
    // {
    //     Model_quan::where("_province_id", $id_tp)->where("_district_id", $id_quan)->get();
    // }
    // public function lay_duong_tu_quan_va_thanh_pho($id_tp, $id_quan)
    // {
    //     Model_quan::where("_province_id", $id_tp)->where("_district_id", $id_quan)->get();

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
        Model_dia_chi::create($request->all());
        return response()->json(["status" => "success"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Model_dia_chi::where("id", $id)->first();
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
        Model_dia_chi::where("id", $id)->update($request->all());
        return response()->json(["status" => "success"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Model_dia_chi::find($id)->delete();
        return response()->json(["status" => "success"]);
    }
}
