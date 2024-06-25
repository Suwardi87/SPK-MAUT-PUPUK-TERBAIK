<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    protected $table = 'kriterias';
//
    protected $fillable = ['nama_kriteria'];

    public function bobots()
    {
        return $this->hasMany(Bobot::class, 'kriteria_id');
    }

    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class, 'supplier_kriterias')
                    ->withPivot('bobot_id', 'SkorUtilitas')
                    ->withTimestamps();
    }
}


