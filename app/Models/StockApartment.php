<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockApartment extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'id_tower', 'id_sales', 'status', 'price', 'unit'
    ];

    protected $hidden = [];

    public function user(){
        return $this->belongsTo(User::class, 'id_sales', 'id');
    }

    public function tower(){
        return $this->belongsTo(Tower::class, 'id_tower', 'id');
    }
}
