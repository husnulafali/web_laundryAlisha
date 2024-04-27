<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers'; 
    protected $primaryKey = 'cd_customer'; 

    protected $fillable = [
        'cd_customer',
        'customer_name',
        'address',
        'no_telp',
    ];
}
