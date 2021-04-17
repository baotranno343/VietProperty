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
// Route::get('dia_chi/{thanh_pho?}/{quan?}/{phuong?}', function ($id_tp, $id_quan, $id_phuong, $id) {
//     //
// });
Route::get('dia_chi/{thanh_pho?}/{quan?}/{phuong?}', [Controller_dia_chi::class, 'lay_thanh_pho']);
// Route::get('dia_chi/all/{id}', function ($id) {
//     // return $id;
//     switch ($id) {
//         case "thanh_pho":
//         case "phuong":
//         case "quan":
//         case "duong":
//             return response()->json(DB::table($id)->get());
//             break;
//         default:
//             break;
//     }
// });

// Route::put('nha/dia_chi/{id}', [Controller_nha::class, 'update_hinh_by_id_nha']);
// Route::post('hinh/{id}/update', [Controller_hinh::class, 'update_hinh']);
Route::get('thong_ke/nha/thang', [Controller_nha::class, 'dem_cac_nha_da_ban_trong_cac_thang']);
Route::get('thong_ke/nha/loai_nha', [Controller_nha::class, 'dem_cac_loai_nha_dang_ban']);
Route::get('thong_ke/nha/quan', [Controller_nha::class, 'dem_nha_theo_quan_dang_ban']);
Route::get('thong_ke/nha/quan_nhieu_nhat', [Controller_nha::class, 'dem_quan_nhieu_nha_nhat']); //
Route::get('thong_ke/khach_hang/thang', [Controller_khach_hang::class, 'dem_cac_khach_hang_dang_ky_cac_thang']);
Route::get('thong_ke/khach_hang/tong', [Controller_khach_hang::class, 'dem_tong_khach_hang_da_dang_ky']); //
Route::get('thong_ke/nha/da_ban', [Controller_nha::class, 'dem_tong_cac_nha_da_ban']); //
Route::get('thong_ke/nha/dang_ban', [Controller_nha::class, 'dem_tong_cac_nha_dang_ban']); //
Route::post('khach_hang/login', [Controller_khach_hang::class, 'login']);
Route::apiResource('khach_hang', Controller_khach_hang::class);
Route::apiResource('nha', Controller_nha::class);
Route::apiResource('loai_nha', Controller_loai_nha::class);
Route::apiResource('hinh', Controller_hinh::class);
Route::apiResource('dia_chi', Controller_dia_chi::class);
