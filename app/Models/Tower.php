<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tower extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'tower_name', 'stock_room'
    ];

    protected $hidden = [];

    public function stocks(){
        return $this->hasMany(StockApartment::class, 'id_tower', 'id');
    }
}
