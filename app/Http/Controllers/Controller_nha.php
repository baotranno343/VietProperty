<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Model_nha;
use Illuminate\Support\Facades\DB;
use App\Models\Model_dia_chi;
use App\Models\Model_hinh;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Resource_nha;

class Controller_nha extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $nha =  DB::table('nha')
            ->join('khach_hang', 'khach_hang.id', '=', 'nha.id_khach_hang')
            ->join('dia_chi', 'nha.id', '=', 'dia_chi.id_nha')
            ->join('thanh_pho', 'thanh_pho.id', '=', 'dia_chi.thanh_pho')
            ->join('quan', 'quan.id', '=', 'dia_chi.quan')
            ->join('phuong', 'phuong.id', '=', 'dia_chi.phuong')
            ->join('duong', 'duong.id', '=', 'dia_chi.duong')
            ->select('nha.id as id_nha', 'nha.banner as banner', 'thanh_pho._name as thanh_pho', 'quan._name as quan', 'phuong._name as phuong', 'duong._name as duong', 'dia_chi.so_nha as so_nha', 'nha.mo_ta as mo_ta', "nha.gia as gia")
            ->get();
        return response()->json($nha);
        // return new Resource_nha($nha);
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
        $input = $request->only(['id_khach_hang', 'hinh_thuc', 'loai_nha', 'lat', 'lon', 'gia', 'dien_tich', 'so_phong', 'so_toilet', 'mo_ta', 'trang_thai', 'duyet']);


        if ($file = $request->file('banner')) {

            $name = uniqid() . "." . $file->extension();
            $file->move(public_path('images'), $name);
            $input["banner"] = $name;
        } else {
            $input["banner"] = "";
        }
        $nha = Model_nha::create($input);
        $nha->save();
        $input2 = $request->only(['thanh_pho', 'quan', 'phuong', 'duong', 'so_nha']);
        $input2["id_nha"] = $nha->id;
        $dia_chi = Model_dia_chi::create($input2);
        $dia_chi->save();
        if ($files = $request->file('images')) {
            foreach ($files as $file) {
                //  $name = uniqid() . $file->getClientOriginalName();
                $name = uniqid() . "." . $file->extension();
                //   Storage::put("public", $name);
                $file->move(public_path('images'), $name);
                Model_hinh::insert([
                    'id_nha' =>   $nha->id,
                    'link' =>  $name,

                    //you can put other insertion here
                ]);
            }
        }
        return response()->json(["status" => "success"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_nha_by_idkh($id)
    {
        $nha =  DB::table('nha')
            ->join('khach_hang', 'khach_hang.id', '=', 'nha.id_khach_hang')->join('dia_chi', 'nha.id', '=', 'dia_chi.id_nha')->join('thanh_pho', 'thanh_pho.id', '=', 'dia_chi.thanh_pho')->join('quan', 'quan.id', '=', 'dia_chi.quan')->join('phuong', 'phuong.id', '=', 'dia_chi.phuong')->join('duong', 'duong.id', '=', 'dia_chi.duong')->select('nha.id as id_nha', 'nha.banner as banner', 'thanh_pho._name as thanh_pho', 'quan._name as quan', 'phuong._name as phuong', 'duong._name as duong', 'dia_chi.so_nha as so_nha', 'nha.mo_ta as mo_ta', "nha.lat as lat", "nha.lon as lon")->where('nha.id_khach_hang', $id)->get();
        // print_r($nha);
        // $hinh = Model_hinh::where("id_nha", $id)->get();
        // $dia_chi = Model_dia_chi::where("id_nha", $id)->get();
        return response()->json(['nha' => $nha]);
    }

    public function show($id)
    {
        $nha =  DB::table('nha')
            ->join('khach_hang', 'khach_hang.id', '=', 'nha.id_khach_hang')->join('dia_chi', 'nha.id', '=', 'dia_chi.id_nha')->join('thanh_pho', 'thanh_pho.id', '=', 'dia_chi.thanh_pho')->join('quan', 'quan.id', '=', 'dia_chi.quan')->join('phuong', 'phuong.id', '=', 'dia_chi.phuong')->join('duong', 'duong.id', '=', 'dia_chi.duong')->select('nha.id as id_nha', 'nha.banner as banner', 'thanh_pho._name as thanh_pho', 'quan._name as quan', 'phuong._name as phuong', 'duong._name as duong', 'dia_chi.so_nha as so_nha', 'nha.mo_ta as mo_ta', "nha.lat as lat", "nha.lon as lon")->where('nha.id', $id)->first();
        // print_r($nha);
        $hinh = Model_hinh::where("id_nha", $id)->get();
        $dia_chi = Model_dia_chi::where("id_nha", $id)->get();
        return response()->json(['nha' => $nha, 'hinh' => $hinh, 'dia_chi' => $dia_chi]);
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
        $input = $request->only(['id_khach_hang', 'hinh_thuc', 'loai_nha', 'lat', 'lon', 'gia', 'dien_tich', 'so_phong', 'so_toilet', 'mo_ta', 'trang_thai', 'duyet']);
        if ($file = $request->file('banner')) {
            $nha = Model_nha::where("id", $id)->first();
            if (Storage::disk('images')->exists($nha->banner)) {
                Storage::disk('images')->delete($nha->banner);
            }
            $name = uniqid() . "." . $file->extension();
            $file->move(public_path('images'), $name);
            $input["banner"] = $name;
        }
        if ($input) {
            $nha = Model_nha::where("id", $id)->update($input);
        }
        $input2 = $request->only(['thanh_pho', 'quan', 'phuong', 'duong', 'so_nha']);
        if ($input2) {
            $dia_chi = Model_dia_chi::where("id_nha", $id)->update($input2);
        }


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
        Model_dia_chi::where("id_nha", $id)->delete();
        $all_hinh = Model_hinh::where("id_nha", $id)->get();
        foreach ($all_hinh as $hinh) {
            if (Storage::disk('images')->exists($hinh->link)) {
                Storage::disk('images')->delete($hinh->link);
            }
        }
        Model_hinh::where("id_nha", $id)->delete();
        Model_nha::find($id)->delete();
        return response()->json(["status" => "success"]);
    }
}