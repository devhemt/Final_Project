<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase_items extends Model
{
    use HasFactory;

    protected $table = 'purchase_items';
    protected $primaryKey = 'id';
    protected $fillable = ['purchase_id','prd_id','quantity','unit_price','batch'];
}
