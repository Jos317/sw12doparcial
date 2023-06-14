<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colabora extends Model
{
    use HasFactory;

    protected $table = 'colabora';
    protected $fillable = ['user_id', 'diagrama_id','habilitado'];
    public $timestamps = false;

}
