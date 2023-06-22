<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $table = 'purchase';
    protected $primaryKey = 'id';
    protected $fillable = ['purchase_code','supplier_id','total_pay'];
}
