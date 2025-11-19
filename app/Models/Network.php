<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Network extends Model
{
    use SoftDeletes;
    
    protected $table = 'tb_network'; 
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_location',
        'id_vendor',
        'brand',
        'production_year',
        'function',
        'serial_number',
        'eosale_date',
        'eosupport_date',
        'status',
        'description'
    ];

    protected $hidden = [];

    protected $casts = [
        'eosale_date'    => 'date',
        'eosupport_date' => 'date',
    ];

    // Relasi dengan model Location
    public function location()
    {
        return $this->belongsTo(Location::class, 'id_location', 'id');
    }

    // Relasi dengan model Vendor
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'id_vendor', 'id');
    }
}