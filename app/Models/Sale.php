<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $table = 'sale';
    protected $primaryKey = 'id';
    protected $fillable = ['category_id','customer_type','sale_name','discount','begin','end'];
}
