<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentConfirmationMail; // Optional jika ingin kirim email

class AppointmentController extends Controller
{
    /**
     * Simpan data appointment dari form.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'mobile' => 'required|string|max:20',
            'doctor' => 'required|string|max:100',
            'date' => 'required|date',
            'time' => 'required|string|max:20',
            'message' => 'nullable|string|max:1000',
        ]);

        // Simpan ke database
        $appointment = Appointment::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'mobile' => $validated['mobile'],
            'doctor' => $validated['doctor'],
            'date' => $validated['date'],
            'time' => $validated['time'],
            'message' => $validated['message'] ?? null,
        ]);

        // (Opsional) Kirim notifikasi email ke pasien
        // Mail::to($appointment->email)->send(new AppointmentConfirmationMail($appointment));

        // Redirect kembali dengan pesan sukses
        return back()->with('success', 'Appointment berhasil dikirim!');
    }

    /**
     * Tampilkan daftar semua appointment (misalnya untuk admin).
     */
    public function index()
    {
        $appointments = Appointment::latest()->get();
        return view('admin.appointments.index', compact('appointments'));
    }

    /**
     * Tampilkan detail appointment tertentu (opsional).
     */
    public function show($id)
    {
        $appointment = Appointment::findOrFail($id);
        return view('admin.appointments.show', compact('appointment'));
    }
}
