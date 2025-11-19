<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendor extends Model
{
    use SoftDeletes;
    
    protected $table = 'tb_vendor'; 
    protected $primaryKey = 'id';
    protected $fillable = [
        'name', 'pic', 'telephone', 'address'
    ];

    protected $hidden = [];

    // public function vendor(){
    //     return $this->hasMany(User::class, 'id_department', 'id');
    // }
}
