<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lisensi extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tb_lisensi';

    protected $fillable = [
        'id_vendor',
        'software_name',
        'function',
        'license_key',
        'seats',
        'start_date',
        'expiry_date',
        'assigned_to',
        'status',
        'file',
        'description',
    ];

    protected $casts = [
        'start_date' => 'date',
        'expiry_date' => 'date',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'id_vendor');
    }
}