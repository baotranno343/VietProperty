<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Model_khach_hang;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Controller_khach_hang extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $khach_hang = Model_khach_hang::get();

        if (!$khach_hang->isEmpty()) {
            return response()->json(["status" => "success", "khach_hang" => $khach_hang]);
        } else {
            return response()->json(["status" => "error"]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dem_cac_khach_hang_dang_ky_cac_thang()
    {

        $nha = DB::table('khach_hang')
            ->select(DB::raw('MONTH(khach_hang.ngay_tao) as thang,count(khach_hang.id) as tong_khach_hang '))->groupBy('thang')->get();
        return $nha;
    }
    public function dem_tong_khach_hang_da_dang_ky()
    {

        $nha = DB::table('khach_hang')->count();
        return $nha;
    }
    public function store(Request $request)
    {

        $input = $request->only(['email', 'sdt', 'mat_khau', 'ho_ten', 'dia_chi', 'chuc_vu']);
        $check_kh = Model_khach_hang::where('email', $input['email'])->first();
        $check_sdt = Model_khach_hang::where('sdt', $input['sdt'])->first();
        if ($check_kh) {
            return response()->json(["status" => "error", "error" => "Email Đã Tồn Tại"]);
        }
        // if ($check_sdt) {
        //     return response()->json(["status"  => "error", "error" => "SĐT Đã Tồn Tại"]);
        // }

        if ($file = $request->file('avatar')) {

            $name = uniqid() . "." . $file->extension();
            $file->move(public_path('images'), $name);
            $input["avatar"] = $name;
        } else {
            $input["avatar"] = "";
        }
        Model_khach_hang::create($input);
        return response()->json(["status" => "success"]);
    }
    public function login(Request $request)
    {
        $status = "error";
        //
        if ($request->email) {
            $khach_hang = Model_khach_hang::where("email", $request->email)->where("mat_khau", $request->mat_khau)->first();
        } else if ($request->sdt) {
            $khach_hang = Model_khach_hang::where("sdt", $request->sdt)->where("mat_khau", $request->mat_khau)->first();
        } else {
            $khach_hang = "";
        }
        if ($khach_hang) {
            $status = "success";
        }
        return response()->json(["status" => $status, "khach_hang" => $khach_hang]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $khach_hang = Model_khach_hang::where("id", $id)->first();
        if ($khach_hang) {
            return response()->json(["status" => "success", "khach_hang" => $khach_hang]);
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
        //   Model_khach_hang::where("id", $id)->update($request->all());
        $input = $request->only(['email', 'sdt', 'mat_khau', 'ho_ten', 'dia_chi', 'chuc_vu']);
        if ($file = $request->file('avatar')) {
            $khach_hang = Model_khach_hang::where("id", $id)->first();
            if (Storage::disk('images')->exists($khach_hang->avatar)) {
                Storage::disk('images')->delete($khach_hang->avatar);
            }
            $name = uniqid() . "." . $file->extension();
            $file->move(public_path('images'), $name);
            $input["avatar"] = $name;
        }
        Model_khach_hang::where("id", $id)->update($input);
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
        $khach_hang = Model_khach_hang::find($id);
        $avatar = $khach_hang->avatar;

        if ($avatar) {
            if (Storage::disk('images')->exists($avatar)) {
                Storage::disk('images')->delete($avatar);
            }
        }
        if ($khach_hang) {
            Model_khach_hang::find($id)->delete();
            return response()->json(["status" => "success"]);
        } else {
            return response()->json(["status" => "error"]);
        }
    }
}
