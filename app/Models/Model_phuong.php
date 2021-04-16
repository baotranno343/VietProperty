<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Model_phuong extends Model
{
    use HasFactory;
    protected $table = 'phuong';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['id', '_name', '_code'];
}
