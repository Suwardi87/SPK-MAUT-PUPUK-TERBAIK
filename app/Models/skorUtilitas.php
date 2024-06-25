<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class skorUtilitas extends Model
{
    protected $fillable = ['SkorUtilitas', 'bobot_id', 'supplier_id'];

    public function bobots()
    {
        return $this->belongsTo(Bobot::class);
    }
}
