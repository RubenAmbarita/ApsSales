<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RiwayatPerawatan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tb_riwayatperawatan';

    protected $fillable = [
        'id_server',
        'treatment_date',
        'treatment_type',
        'description',
        'cost',
        'long_warranty',
    ];

    protected $casts = [
        'treatment_date' => 'date',
    ];

    public function server()
    {
        return $this->belongsTo(Server::class, 'id_server');
    }
}