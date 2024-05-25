<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $primaryKey = 'cd_orders'; // Menetapkan primary key

    protected $keyType = 'string'; // Menetapkan tipe primary key sebagai string (UUID)

    public $incrementing = false; // Tidak ada penambahan increment pada UUID

    protected $fillable = [
        'cd_orders',
        'cd_customers',
        'cd_packets',
        'order_date',
        'weight',
        'discount',
        'total_payment',
        'payment_date',
        'payment_status',
         'laundry_status',
         'note',
          
    ];

    public function customers()
    {
        return $this->belongsTo(Customer::class, 'cd_customers', 'cd_customers');
    }
    public function packets()
    {
        return $this->belongsTo(Packet::class, 'cd_packets', 'cd_packets');
    }
 

  
}
