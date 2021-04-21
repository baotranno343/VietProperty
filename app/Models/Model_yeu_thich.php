<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Model_yeu_thich extends Model
{
    use HasFactory;
    protected $table = 'yeu_thich';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['id_khach_hang', 'id_nha'];
}
