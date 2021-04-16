<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Model_quan extends Model
{
    use HasFactory;
    protected $table = 'quan';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['id', '_name', '_prefix', '_province_id'];
}
