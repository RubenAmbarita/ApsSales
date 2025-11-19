<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use SoftDeletes;
    
    protected $table = 'tb_location'; 
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'location',
        'room',
        'floor'
    ];

    protected $hidden = [];

    // Relasi dengan model Network
    public function networks()
    {
        return $this->hasMany(Network::class, 'id_location', 'id');
    }
}