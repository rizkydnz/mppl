<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Diagnosa;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'email',
        'mobile',
        'date',
        'time',
        'message',
        'dokter_id', // pastikan ini juga di-fillable jika kamu pakai
    ];

    protected static function booted(): void
    {
        static::created(function ($appointment) {
            Diagnosa::create([
                'appointment_id' => $appointment->id,
                'dokter_id' => $appointment->dokter_id ?? 1, // ganti default ID jika perlu
                'keluhan' => $appointment->message ?? '',
                'status' => 'Belum Diperiksa',
            ]);
        });
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }

    public function diagnosa()
    {
        return $this->hasOne(Diagnosa::class);
    }
}

