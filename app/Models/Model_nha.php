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
    protected $fillable = ['id_khach_hang', 'hinh_thuc', 'loai_nha', 'x', 'y', 'gia', 'dien_tich', 'so_phong', 'so_toilet', 'banner', 'mo_ta', 'trang_thai', 'duyet'];
}
