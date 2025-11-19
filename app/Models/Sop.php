<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sop extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tb_sop';

    protected $fillable = [
        'no_sop',
        'name',
        'version',
        'file',
        'retention_period',
        'id_department',
        'effective_date',
        'approved_by',
    ];

    protected $casts = [
        'effective_date' => 'date',
    ];

    public function departemen()
    {
        return $this->belongsTo(\App\Models\Departemen::class, 'id_department', 'id');
    }
}