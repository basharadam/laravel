<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RFQ extends Model
{
    use HasFactory;
    // app/Models/RFQ.php
    protected $table = 'rfqs'; // ✅ explicitly define the table name

    protected $fillable = ['title', 'notes', 'deadline'];

}
