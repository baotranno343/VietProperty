<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Model_nha extends Model
{
    use HasFactory;

    protected $table = 'nha';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['id_khach_hang', 'hinh_thuc', 'loai_nha', 'lat', 'lon', 'gia', 'dien_tich', 'so_phong', 'so_toilet', 'banner', 'hinh', 'mo_ta', 'thanh_pho', 'quan', 'phuong', 'duong', 'so_nha', 'trang_thai', 'duyet'];
}
