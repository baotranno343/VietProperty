<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Model_loai_nha extends Model
{
    use HasFactory;
    protected $table = 'loai_nha';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['ten'];
}
