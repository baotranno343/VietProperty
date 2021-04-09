<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Model_khach_hang;
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
        return response()->json($khach_hang);
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
    public function store(Request $request)
    {
        //
        $input = $request->only(['email', 'sdt', 'mat_khau', 'ho_ten', 'dia_chi', 'chuc_vu']);
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Model_khach_hang::where("id", $id)->first();
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
        Model_khach_hang::find($id)->delete();
        return response()->json(["status" => "success"]);
    }
}