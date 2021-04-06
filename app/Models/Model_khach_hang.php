<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Model_khach_hang extends Model
{
    use HasFactory;

    protected $table = 'khach_hang';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['email', 'sdt', 'mat_khau', 'ho_ten', 'dia_chi', 'chuc_vu'];
}
