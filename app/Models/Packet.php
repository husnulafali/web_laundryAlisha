<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Packet extends Model
{
    use HasFactory;

    protected $table = 'packets'; 
    protected $primaryKey = 'cd_packets'; 
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'cd_packets',
        'packet_name',
        'description',
        'processing_time',
        'price'
    ];

    protected $casts = [
        'price' => 'float',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'cd_packets', 'cd_packets');
    }
  
    

}
