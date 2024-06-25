<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'suppliers';
    protected $fillable = ['nama_supplier'];

    public function kriterias()
    {
        return $this->belongsToMany(Kriteria::class, 'supplier_kriterias')
            ->withPivot('bobot_id', 'SkorUtilitas')
            ->withTimestamps();
    }

    public function supplierKriterias()
    {
        return $this->hasMany(SupplierKriteria::class, 'supplier_id');
    }
}
