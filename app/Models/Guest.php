<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    protected $table = 'guest';
    protected $primaryKey = 'id';
    protected $fillable = ['session_id','name','email','phone'];
}
