<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierKriteria extends Model
{
    use HasFactory;

    protected $fillable = ['supplier_id', 'kriteria_id', 'bobot', 'SkorUtilitas'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'kriteria_id');
    }

    public function bobot()
    {
        return $this->belongsTo(Bobot::class, 'bobot_id');
    }
}
