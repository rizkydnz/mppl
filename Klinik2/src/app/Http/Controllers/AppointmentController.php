<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Transaction;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentConfirmationMail; // Optional jika ingin kirim email

class AppointmentController extends Controller
{
    /**
     * Simpan data appointment dari form.
     */
public function store(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'email' => 'required|email',
        'mobile' => 'required|string|max:20',
        'date' => 'required|date',
        'time' => 'required',
        'message' => 'required|array|min:1',
    ]);

    Appointment::create([
        'nama' => $request->nama,
        'email' => $request->email,
        'mobile' => $request->mobile,
        'date' => $request->date,
        'time' => $request->time,
        'message' => implode(', ', $request->message), // Jika disimpan sebagai string
    ]);

    return redirect()->back()->with('success', 'Janji temu berhasil dibuat!');
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

    public function payment($id)
{
    $appointment = Appointment::findOrFail($id);
    $transaction = Transaction::where('appointment_id', $id)->first();

    if (!$transaction) {
        // Jika belum ada transaksi, buat transaksi baru
        $transaction = Transaction::create([
            'appointment_id' => $id,
            'invoice_code' => 'INV-' . strtoupper(uniqid()),
            'amount' => 150000, // contoh biaya tetap, bisa dinamis
            'status' => 'unpaid'
        ]);
    }

    return view('frontend.payment', compact('appointment', 'transaction'));
}

    public function pay($id)
    {
        $transaction = Transaction::where('appointment_id', $id)->firstOrFail();
        $transaction->status = 'paid';
        $transaction->save();

        return redirect()->route('appointment.payment', $id)->with('success', 'Pembayaran berhasil!');
    }
}

        