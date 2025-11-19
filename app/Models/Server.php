<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Server extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tb_server';

    protected $fillable = [
        'no_rack',
        'rack_unit',
        'brand',
        'model',
        'serial_number',
        'application',
        'status',
        'procurement_date',
        'acquition_date',
        'description',
    ];

    protected $casts = [
        'procurement_date' => 'date',
        'acquition_date' => 'date',
    ];
}