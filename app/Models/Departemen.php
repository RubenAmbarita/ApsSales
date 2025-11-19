<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Departemen extends Model
{
    use SoftDeletes;
    
    protected $table = 'tb_department'; 
    protected $primaryKey = 'id';
    protected $fillable = [
        'name', 'description'
    ];

    protected $hidden = [];

    public function departemen(){
        return $this->hasMany(User::class, 'id_department', 'id');
    }
}
