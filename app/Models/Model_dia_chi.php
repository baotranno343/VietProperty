<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Model_dia_chi extends Model
{
    use HasFactory;

    protected $table = 'dia_chi';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['id_nha', 'thanh_pho', 'quan', 'phuong', 'duong', 'so_nha'];
}
