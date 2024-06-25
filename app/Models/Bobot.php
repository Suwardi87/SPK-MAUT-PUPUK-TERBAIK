<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bobot extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function kriterias()
    {
        return $this->hasMany(Kriteria::class, 'bobot_id');
    }
}
