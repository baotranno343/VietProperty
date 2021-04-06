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
        $hinh = Model_hinh::where("id_nha", $id)->first();
        //$check = 0;
        $mang_hinh = [];
        $datas = explode("|", $hinh->link);


        if ($files = $request->file('images')) {

            foreach ($files as $file) {
                $check = 0;
                foreach ($datas as $data) {

                    //echo $file->getClientOriginalName() . "\n";
                    if ($file->getClientOriginalName() == $data) {
                        $check = 1;
                        array_push($mang_hinh, $data);

                        continue;
                    }
                }
                if ($check != 1) {

                    $name = uniqid() . $file->getClientOriginalName();

                    //   Storage::put("public", $name);
                    $file->move(public_path('images'), $name);
                    // array_push($mang_hinh, $name);
                    array_push($mang_hinh, $name);
                }
            }
        }
        foreach ($datas as $item) {
            if (!in_array($item, $mang_hinh)) {
                // echo $item;
                if (Storage::disk('images')->exists($item)) {
                    Storage::disk('images')->delete($item);
                }
            }
        }

        Model_hinh::where("id_nha", $id)->update([
            'id_nha' =>  $id,
            'link' =>  implode("|", $mang_hinh),
        ]);
        return $mang_hinh;
        // foreach ($datas as $data) {
        //     foreach ($files as $file) {
        //         if ($data == $file) {
        //             $check = 1;
        //             continue;
        //         }
        //     }
        //     if ($check != 1) {
        //         if (Storage::disk('images')->exists($data)) {
        //             Storage::disk('images')->delete($data);
        //         }
        //     }



        // $images = array();
        // if ($files = $request->file('images')) {
        //     foreach ($files as $file) {
        //         $name = uniqid() . $file->getClientOriginalName();
        //         //   Storage::put("public", $name);
        //         $file->move(public_path('images'), $name);
        //         $images[] = $name;
        //     }
        // }
        // /*Insert your data*/

        // Model_hinh::where("id", $id)->update([
        //     'id_nha' =>  37,
        //     'link' =>  implode("|", $images),

        //     //you can put other insertion here
        // ]);
        //1 2 3 4 5
        // 3 1 7 8 9

        // Model_hinh::where("id_nha", $id)->update($request->all());
        // return response()->json(["status" => "success"]);
        //  return $hinh->link;
    }
    public function update(Request $request, $id)
    {
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

        $hinh = Model_hinh::where("id", $id)->get();

        if (Storage::disk('images')->exists($hinh->link)) {
            Storage::disk('images')->delete($hinh->link);
        }
        Model_hinh::find($id)->delete();
        return response()->json(["status" => "success"]);
    }
}
