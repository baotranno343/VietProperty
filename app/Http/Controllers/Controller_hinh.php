<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Model_hinh;
use Illuminate\Support\Facades\Storage;

class Controller_hinh extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hinh = Model_hinh::get();
        return response()->json($hinh);
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
        // Model_hinh::create($request->all());

        $images = array();
        if ($files = $request->file('images')) {
            foreach ($files as $file) {
                //  $name = uniqid() . $file->getClientOriginalName();
                $name = uniqid() . "." . $request->file('images')->extension();
                //   Storage::put("public", $name);
                $file->move(public_path('images'), $name);
                Model_hinh::insert([
                    'id_nha' =>  $request->id_nha,
                    'link' =>  $name,

                    //you can put other insertion here
                ]);
            }
        }
        /*Insert your data*/


        return response()->json(["status" => "success"]);
        // return response()->json(["status" => "success"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Model_hinh::where("id", $id)->first();
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
    public function update_hinh(Request $request, $id)
    {
        if ($file = $request->file('images')) {
            //  $name = uniqid() . $file->getClientOriginalName();
            $name = uniqid() . "." . $file->extension();
            //   Storage::put("public", $name);
            $file->move(public_path('images'), $name);
            $hinh = Model_hinh::where("id", $id)->update(['link' => $name]);
            // Model_hinh::insert([
            //     'id_nha' =>  $request->id_nha,
            //     'link' =>  $name,

            //     //you can put other insertion here
            // ]);

        }
        if ($file2 = $request->old_image) {
            print_r(Storage::disk('images')->exists($file2));

            if (Storage::disk('images')->exists($file2)) {

                Storage::disk('images')->delete($file2);
            }
        }
        return response()->json(["status" => "success"]);
    }
    public function update(Request $request, $id)
    {
        if ($file = $request->file('images')) {
            //  $name = uniqid() . $file->getClientOriginalName();
            $name = uniqid() . "." . $file->extension();
            //   Storage::put("public", $name);
            $file->move(public_path('images'), $name);
            $hinh = Model_hinh::where("id", $id)->update(['link' => $name]);
            // Model_hinh::insert([
            //     'id_nha' =>  $request->id_nha,
            //     'link' =>  $name,

            //     //you can put other insertion here
            // ]);

        }
        if ($file2 = $request->old_image) {
            print_r(Storage::disk('images')->exists($file2));

            if (Storage::disk('images')->exists($file2)) {

                Storage::disk('images')->delete($file2);
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
        // Model_hinh::where("id_nha", $id)->first();

        $hinh = Model_hinh::where("id", $id)->first();

        if (Storage::disk('images')->exists($hinh->link)) {
            Storage::disk('images')->delete($hinh->link);
        }
        Model_hinh::find($id)->delete();
        return response()->json(["status" => "success"]);
    }
}