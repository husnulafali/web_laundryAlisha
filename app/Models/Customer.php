<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers'; 
    protected $primaryKey = 'cd_customers'; 
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'cd_customers',
        'customer_name',
        'address',
        'phone_number',
    ];
    public function orders()
    {
        return $this->hasMany(Order::class, 'cd_customers', 'cd_customers');
    }
   
    
}
