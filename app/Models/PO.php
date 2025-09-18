<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class PO extends Model
{
    use HasFactory;
    protected $table = 'purchase_orders'; // ✅ explicitly define the table name
    protected $fillable = [
        'rfq_id',
        'bid_id',
        'vendor_name',
        'price',
        'status',
        'payment_confirmed',
    ];
   
}
