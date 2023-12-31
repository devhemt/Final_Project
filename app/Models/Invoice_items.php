<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice_items extends Model
{
    use HasFactory;

    protected $table = 'invoice_items';
    protected $primaryKey = 'id';
    protected $fillable = ['property_id','invoice_id','size','color','amount'];
}
