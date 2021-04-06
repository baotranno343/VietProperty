<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller_khach_hang;
use App\Http\Controllers\Controller_nha;
use App\Http\Controllers\Controller_loai_nha;
use App\Http\Controllers\Controller_hinh;
use App\Http\Controllers\Controller_dia_chi;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('dia_chi/all/{id}', function ($id) {
    // return $id;
    switch ($id) {
        case "thanh_pho":
        case "phuong":
        case "quan":
        case "duong":
            return response()->json(DB::table($id)->get());
            break;
        default:
            break;
    }
});

Route::put('nha/dia_chi/{id}', [Controller_nha::class, 'update_hinh_by_id_nha']);
Route::post('hinh/{id}/update', [Controller_hinh::class, 'update_hinh']);
Route::apiResource('khach_hang', Controller_khach_hang::class);
Route::apiResource('nha', Controller_nha::class);
Route::apiResource('loai_nha', Controller_loai_nha::class);
Route::apiResource('hinh', Controller_hinh::class);
Route::apiResource('dia_chi', Controller_dia_chi::class);
