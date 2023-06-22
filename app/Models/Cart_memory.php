<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart_memory extends Model
{
    use HasFactory;

    protected $table = 'cart_memory';
    protected $primaryKey = 'id';
    protected $fillable = ['prd_id','customer_id','size','color','amount'];
}
