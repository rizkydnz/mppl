<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    use HasFactory;

    protected $fillable = [
        'diagnosa_id',
        'obat_id',
    ];
    public function diagnosa()
    {
        return $this->belongsTo(Diagnosa::class);
    }

    public function obat()
    {
        return $this->belongsTo(Obat::class);
    }

}
