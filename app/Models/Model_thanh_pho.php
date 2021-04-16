<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Model_thanh_pho extends Model
{
    use HasFactory;
    protected $table = 'thanh_pho';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['id', '_name', '_code'];
}
