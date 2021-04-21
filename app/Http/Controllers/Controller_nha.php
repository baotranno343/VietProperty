<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Model_nha;
use Illuminate\Support\Facades\DB;
use App\Models\Model_hinh;
use App\Models\Model_yeu_thich;
use Illuminate\Support\Facades\Storage;

class Controller_nha extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function hien_nha_theo_hinh_thuc($id)
    {

        $nha =  DB::table('nha')
            ->join('loai_nha', 'loai_nha.id', '=', 'nha.loai_nha')
            ->join('khach_hang', 'khach_hang.id', '=', 'nha.id_khach_hang')
            ->join('thanh_pho', 'thanh_pho.id', '=', 'nha.thanh_pho')
            ->join('quan', 'quan.id', '=', 'nha.quan')
            ->join('phuong', 'phuong.id', '=', 'nha.phuong')
            ->join('duong', 'duong.id', '=', 'nha.duong')
            ->select('nha.id as id_nha', 'nha.id_khach_hang as id_khach_hang', 'nha.hinh_thuc as hinh_thuc', 'loai_nha.ten as loai_nha', 'nha.lat as lat', 'nha.lon as lon', 'nha.gia as gia', 'nha.dien_tich as dien_tich', 'nha.so_phong as so_phong',  'nha.so_toilet as so_toilet', 'nha.banner as banner', 'nha.mo_ta as mo_ta', 'thanh_pho._name as thanh_pho', 'quan._name as quan', 'phuong._name as phuong', 'duong._name as duong', 'nha.so_nha as so_nha', 'nha.trang_thai as trang_thai', "nha.duyet as duyet")
            ->where("hinh_thuc", $id)
            ->where("trang_thai", 1)
            ->get();
        if (!$nha->isEmpty()) {
            return response()->json(["status" => "success", "nha" => $nha]);
        } else {
            return response()->json(["status" => "error"]);
        }

        // return new Resource_nha($nha);
    }
    public function index_show()
    {

        $nha =  DB::table('nha')
            ->join('loai_nha', 'loai_nha.id', '=', 'nha.loai_nha')
            ->join('khach_hang', 'khach_hang.id', '=', 'nha.id_khach_hang')
            ->join('thanh_pho', 'thanh_pho.id', '=', 'nha.thanh_pho')
            ->join('quan', 'quan.id', '=', 'nha.quan')
            ->join('phuong', 'phuong.id', '=', 'nha.phuong')
            ->join('duong', 'duong.id', '=', 'nha.duong')
            ->select('nha.id as id_nha', 'nha.id_khach_hang as id_khach_hang', 'nha.hinh_thuc as hinh_thuc', 'loai_nha.ten as loai_nha', 'nha.lat as lat', 'nha.lon as lon', 'nha.gia as gia', 'nha.dien_tich as dien_tich', 'nha.so_phong as so_phong',  'nha.so_toilet as so_toilet', 'nha.banner as banner', 'nha.mo_ta as mo_ta', 'thanh_pho._name as thanh_pho', 'quan._name as quan', 'phuong._name as phuong', 'duong._name as duong', 'nha.so_nha as so_nha', 'nha.trang_thai as trang_thai', "nha.duyet as duyet", "nha.ngay_tao as ngay_tao")
            ->where("trang_thai", 1);
        if (request()->has('hinh_thuc')) {
            $hinh_thuc = request()->query('hinh_thuc');
            $nha = $nha->where("hinh_thuc", $hinh_thuc)->get();
        } else {
            $nha = $nha->get();
        }

        if (!$nha->isEmpty()) {
            return response()->json(["status" => "success", "nha" => $nha]);
        } else {
            return response()->json(["status" => "error"]);
        }

        // return new Resource_nha($nha);
    }
    public function index()
    {

        $nha =  DB::table('nha')
            ->join('loai_nha', 'loai_nha.id', '=', 'nha.loai_nha')
            ->join('khach_hang', 'khach_hang.id', '=', 'nha.id_khach_hang')
            ->join('thanh_pho', 'thanh_pho.id', '=', 'nha.thanh_pho')
            ->join('quan', 'quan.id', '=', 'nha.quan')
            ->join('phuong', 'phuong.id', '=', 'nha.phuong')
            ->join('duong', 'duong.id', '=', 'nha.duong')
            ->select('nha.id as id_nha', 'nha.id_khach_hang as id_khach_hang', 'nha.hinh_thuc as hinh_thuc', 'loai_nha.ten as loai_nha', 'nha.lat as lat', 'nha.lon as lon', 'nha.gia as gia', 'nha.dien_tich as dien_tich', 'nha.so_phong as so_phong',  'nha.so_toilet as so_toilet', 'nha.banner as banner', 'nha.mo_ta as mo_ta', 'thanh_pho._name as thanh_pho', 'quan._name as quan', 'phuong._name as phuong', 'duong._name as duong', 'nha.so_nha as so_nha', 'nha.trang_thai as trang_thai', "nha.duyet as duyet", "nha.ngay_tao as ngay_tao")
            ->get();
        if (!$nha->isEmpty()) {
            return response()->json(["status" => "success", "nha" => $nha]);
        } else {
            return response()->json(["status" => "error"]);
        }

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
        $input = $request->only(['id_khach_hang', 'hinh_thuc', 'loai_nha', 'lat', 'lon', 'gia', 'dien_tich', 'so_phong', 'so_toilet', 'banner', 'mo_ta', 'thanh_pho', 'quan', 'phuong', 'duong', 'so_nha', 'trang_thai', 'duyet']);


        if ($file = $request->file('banner')) {

            $name = uniqid() . "." . $file->extension();
            $file->move(public_path('images'), $name);
            $input["banner"] = $name;
        } else {
            $input["banner"] = "";
        }
        $nha = Model_nha::create($input);
        $nha->save();
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
    public function them_yeu_thich(Request $request)
    {
        $input = $request->only(['id_khach_hang', 'id_nha']);
        $nha = Model_yeu_thich::create($input);
        $nha->save();
        return response()->json(["status" => "success"]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_yeu_thich_by_idkh($id)
    {
        $yeu_thich = Model_yeu_thich::where("id_khach_hang", $id)->get();


        if (!$yeu_thich->isEmpty()) {
            return response()->json(["status" => "success", "nha" => $yeu_thich]);
        } else {
            return response()->json(["status" => "error"]);
        }
    }
    public function show_nha_by_idkh($id)
    {
        $nha =  DB::table('nha')
            ->join('loai_nha', 'loai_nha.id', '=', 'nha.loai_nha')
            ->join('khach_hang', 'khach_hang.id', '=', 'nha.id_khach_hang')
            ->join('thanh_pho', 'thanh_pho.id', '=', 'nha.thanh_pho')
            ->join('quan', 'quan.id', '=', 'nha.quan')
            ->join('phuong', 'phuong.id', '=', 'nha.phuong')
            ->join('duong', 'duong.id', '=', 'nha.duong')
            ->select('nha.id as id_nha', 'nha.id_khach_hang as id_khach_hang', 'nha.hinh_thuc as hinh_thuc', 'loai_nha.ten as loai_nha', 'nha.lat as lat', 'nha.lon as lon', 'nha.gia as gia', 'nha.dien_tich as dien_tich', 'nha.so_phong as so_phong',  'nha.so_toilet as so_toilet', 'nha.banner as banner',  'nha.mo_ta as mo_ta', 'thanh_pho._name as thanh_pho', 'quan._name as quan', 'phuong._name as phuong', 'duong._name as duong', 'nha.so_nha as so_nha', 'nha.trang_thai as trang_thai', "nha.duyet as duyet", "nha.ngay_tao as ngay_tao")->where('nha.id_khach_hang', $id)->get();

        if (!$nha->isEmpty()) {
            return response()->json(["status" => "success", "nha" => $nha]);
        } else {
            return response()->json(["status" => "error"]);
        }
    }
    //thongke
    public function dem_nha_theo_quan_dang_ban()
    {

        $nha = DB::table('nha')->join('khach_hang', 'khach_hang.id', '=', 'nha.id_khach_hang')
            ->join('loai_nha', 'loai_nha.id', '=', 'nha.loai_nha')
            ->join('thanh_pho', 'thanh_pho.id', '=', 'nha.thanh_pho')
            ->join('quan', 'quan.id', '=', 'nha.quan')
            ->join('phuong', 'phuong.id', '=', 'nha.phuong')
            ->join('duong', 'duong.id', '=', 'nha.duong')
            ->where("nha.trang_thai", 1)
            ->select(DB::raw('count(nha.id) as tong_nha, quan._name as ten_quan'))->groupBy('ten_quan')->orderByDesc('tong_nha')->get();
        return $nha;
    }
    public function dem_quan_nhieu_nha_nhat()
    {

        $nha = DB::table('nha')->join('khach_hang', 'khach_hang.id', '=', 'nha.id_khach_hang')
            ->join('loai_nha', 'loai_nha.id', '=', 'nha.loai_nha')
            ->join('thanh_pho', 'thanh_pho.id', '=', 'nha.thanh_pho')
            ->join('quan', 'quan.id', '=', 'nha.quan')
            ->join('phuong', 'phuong.id', '=', 'nha.phuong')
            ->join('duong', 'duong.id', '=', 'nha.duong')
            ->select(DB::raw('count(nha.id) as tong_nha, quan._name as ten_quan'))->groupBy('ten_quan')->orderByDesc('tong_nha')->limit(1)->get();
        return $nha;
    }
    public function dem_cac_loai_nha_dang_ban()
    {

        $nha = DB::table('nha')->join('khach_hang', 'khach_hang.id', '=', 'nha.id_khach_hang')
            ->join('loai_nha', 'loai_nha.id', '=', 'nha.loai_nha')
            ->join('thanh_pho', 'thanh_pho.id', '=', 'nha.thanh_pho')
            ->join('quan', 'quan.id', '=', 'nha.quan')
            ->join('phuong', 'phuong.id', '=', 'nha.phuong')
            ->join('duong', 'duong.id', '=', 'nha.duong')
            ->where("nha.trang_thai", 1)
            ->select(DB::raw('count(nha.id) as tong_nha, loai_nha.ten as ten_loai_nha'))->groupBy('ten_loai_nha')->orderByDesc('tong_nha')->get();
        return $nha;
    }
    public function dem_cac_nha_da_ban_trong_cac_thang()
    {

        $nha = DB::table('nha')->join('khach_hang', 'khach_hang.id', '=', 'nha.id_khach_hang')
            ->join('loai_nha', 'loai_nha.id', '=', 'nha.loai_nha')
            ->join('thanh_pho', 'thanh_pho.id', '=', 'nha.thanh_pho')
            ->join('quan', 'quan.id', '=', 'nha.quan')
            ->join('phuong', 'phuong.id', '=', 'nha.phuong')
            ->join('duong', 'duong.id', '=', 'nha.duong')
            ->where("nha.trang_thai", 2)
            ->select(DB::raw('MONTH(nha.ngay_tao) as thang,count(nha.trang_thai) as da_ban '))->groupBy('thang')->get();
        return $nha;
    }
    public function dem_tong_cac_nha_dang_ban()
    {

        $nha = DB::table('nha')->join('khach_hang', 'khach_hang.id', '=', 'nha.id_khach_hang')
            ->join('loai_nha', 'loai_nha.id', '=', 'nha.loai_nha')
            ->join('thanh_pho', 'thanh_pho.id', '=', 'nha.thanh_pho')
            ->join('quan', 'quan.id', '=', 'nha.quan')
            ->join('phuong', 'phuong.id', '=', 'nha.phuong')
            ->join('duong', 'duong.id', '=', 'nha.duong')
            ->where("nha.trang_thai", 1)
            ->count();
        return $nha;
    }
    public function dem_tong_cac_nha_da_ban()
    {

        $nha = DB::table('nha')->join('khach_hang', 'khach_hang.id', '=', 'nha.id_khach_hang')
            ->join('loai_nha', 'loai_nha.id', '=', 'nha.loai_nha')
            ->join('thanh_pho', 'thanh_pho.id', '=', 'nha.thanh_pho')
            ->join('quan', 'quan.id', '=', 'nha.quan')
            ->join('phuong', 'phuong.id', '=', 'nha.phuong')
            ->join('duong', 'duong.id', '=', 'nha.duong')
            ->where("nha.trang_thai", 2)
            ->count();
        return $nha;
    }
    //thongke
    public function show($id)
    {
        $nha =  DB::table('nha')
            ->join('loai_nha', 'loai_nha.id', '=', 'nha.loai_nha')
            ->join('khach_hang', 'khach_hang.id', '=', 'nha.id_khach_hang')
            ->join('thanh_pho', 'thanh_pho.id', '=', 'nha.thanh_pho')
            ->join('quan', 'quan.id', '=', 'nha.quan')
            ->join('phuong', 'phuong.id', '=', 'nha.phuong')
            ->join('duong', 'duong.id', '=', 'nha.duong')
            ->select('nha.id as id_nha', 'nha.id_khach_hang as id_khach_hang', 'nha.hinh_thuc as hinh_thuc', 'loai_nha.ten as loai_nha', 'nha.lat as lat', 'nha.lon as lon', 'nha.gia as gia', 'nha.dien_tich as dien_tich', 'nha.so_phong as so_phong',  'nha.so_toilet as so_toilet', 'nha.banner as banner', 'nha.mo_ta as mo_ta', 'thanh_pho._name as thanh_pho', 'quan._name as quan', 'phuong._name as phuong', 'duong._name as duong', 'nha.so_nha as so_nha', 'nha.trang_thai as trang_thai', "nha.duyet as duyet", "nha.ngay_tao as ngay_tao")->where('nha.id', $id)->first();
        // print_r($nha);
        $hinh = Model_hinh::where("id_nha", $id)->get();
        if ($nha) {
            return response()->json(["status" => "success", "nha" => $nha, "hinh" => $hinh]);
        } else {
            return response()->json(["status" => "error"]);
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
        $input = $request->only(['id_khach_hang', 'hinh_thuc', 'loai_nha', 'lat', 'lon', 'gia', 'dien_tich', 'so_phong', 'so_toilet', 'banner', 'mo_ta', 'thanh_pho', 'quan', 'phuong', 'duong', 'so_nha', 'trang_thai', 'duyet']);
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
        if ($files = $request->file('images')) {
            foreach ($files as $file) {
                //  $name = uniqid() . $file->getClientOriginalName();
                $name = uniqid() . "." . $file->extension();
                //   Storage::put("public", $name);
                $file->move(public_path('images'), $name);
                Model_hinh::insert([
                    'id_nha' =>   $id,
                    'link' =>  $name,

                    //you can put other insertion here
                ]);
            }
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
        $all_hinh = Model_hinh::where("id_nha", $id)->get();
        foreach ($all_hinh as $hinh) {
            if (Storage::disk('images')->exists($hinh->link)) {
                Storage::disk('images')->delete($hinh->link);
            }
        }
        Model_hinh::where("id_nha", $id)->delete();
        $nha = Model_nha::find($id);
        $banner = $nha->banner;

        if ($banner) {
            if (Storage::disk('images')->exists($banner)) {
                Storage::disk('images')->delete($banner);
            }
        }
        if ($nha) {
            $nha->delete();
            return response()->json(["status" => "success"]);
        } else {
            return response()->json(["status" => "error"]);
        }
    }
}
